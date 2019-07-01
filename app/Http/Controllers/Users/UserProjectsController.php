<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Services\Projects\ProjectService;

use App\Models\Projects\Project;
use App\Models\Projects\Step;
use App\Models\Projects\Production;

use App\Models\Users\User;

use App\Notifications\User\Projects\ProjectNotification;
use App\Notifications\NewProjectNotification;

use App\Http\Requests\Users\Projects\UploadBomRequest;
use App\Http\Requests\Users\Projects\UploadDwgRequest;
use App\Http\Requests\Users\Projects\UploadDataRequest;

use Carbon\Carbon;

use Exception;

class UserProjectsController extends Controller
{
	public function index(User $user)
	{
		$data = [
			'projects'	=> $user->projects->load('status')
		];

		return view('users.projects.index', $data);
	}

	public function store(User $user, Request $request)
	{
		$input = $request->all();

		$project = ProjectService::create($input);

		if (!$project) {
			return back()->withErrors([trans('manage_projects.create.error')]);
		}

		// Notificamos al sistema en general.
		NewProjectNotification::SystemNotify($project);

		// Notification user
		$user->notify(new ProjectNotification($project));

		return redirect()->route('user::projects.show', [
			'user' => $user,
			'user_project' => $project
		])->with('status', trans('manage_projects.create.success'));
	}

	// "Router" que se va a encargar de redigir a step en caso de que el status tengo varios.
	public function show(User $user, Project $user_project)
	{
		if ($user_project->status->hasSteps() && !$user_project->completedAllSteps() && $user_project->status->stepsInSingleRoute() ) {

			return redirect()->route('user::projects.step', [
				'user' => $user,
				'user_project' => $user_project,
				'step' => $user_project->currentStep()->slug,
			])->withStatus('Please complete al steps in this status.');

		}

		// Obtenemos el estatus en el que se encuentra.
		$method = 'handle'.studly_case(str_replace('.', '_', $user_project->status->slug));

		if (method_exists($this, $method)) {
			return $this->{$method}($user, $user_project);
		} else {
			return $this->noMethod($user, $user_project);
		}
	}

	// Método para manejar la ruta de steps.
	public function step(User $user, Project $user_project, $step)
	{
		if (!$user_project->status->hasSteps() || !$user_project->status->stepsInSingleRoute() ) {

			return redirect()->route('user::projects.show', [
				'user' => $user,
				'user_project' => $user_project,
			]);

		}

		$step = Step::find($step);

		$data = [
			'project' => $user_project,
			'step' => $step
		];

		return view('users.projects.show', $data);
	}

	// Método catch all (si no hay método para ese estatus cae aquí.).
	public function noMethod(User $user, Project $project)
	{
		$data = [
			'project' => $project,
		];

		return view('users.projects.show', $data);
	}

	// Método cuando el estatus es quoted
	public function handleQuoted(User $user, Project $project)
	{
		$data = [
			'project' => $project,
			'quote' => $project->last_quote
		];

		return view('users.projects.show', $data);
	}

	// Método cuando el estatus es pending payment necesitamos más lógica
	public function handlePendingPayment(User $user, Project $project)
	{
		$cards = collect([]);

		if ($user->hasStripeId()) {
			$cards = $user->cards();
		}

		$data = [
			'project' => $project,
			'quote' => $project->accepted_quote,
			'cards' => $cards
		];

		return view('users.projects.show', $data);
	}

	// Método cuando el estatus es pending payment necesitamos más lógica
	public function handlePendingApproval(User $user, Project $project)
	{
		$data = [
			'project' => $project,
			'placement' => $project->getFileByUse('placement')
		];

		return view('users.projects.show', $data);
	}

	// Método cuando el estatus es pending payment necesitamos más lógica
	public function handleDelivered(User $user, Project $project)
	{
		$data = [
			'project' => $project,
			'output' => $project->getFileByUse('output')
		];

		return view('users.projects.show', $data);
	}

	// Método para mostrar la info del proyecto.
	public function info(User $user, Project $user_project)
	{
		return view('users.projects.info', ['project' => $user_project]);
	}

	// Método para mostrar el log del proyecto.
	public function log(User $user, Project $user_project)
	{
		$history = collect([]);

		$history = $history->merge($user_project->notes);

		$history = $history->merge($user_project->quotes);

		$data = [
			'project' => $user_project,
			'history' => $history->sortByDesc('created_at')
		];

		return view('users.projects.log', $data);
	}

	// Methods for the projects forms.

	// Upload bomfile
	public function bomFile(User $user, Project $user_project, UploadBomRequest $request)
	{
		// Eliminamos el file asociado.
		$user_project->files()->wherePivot('use', 'bom')->detach();

		try {
			// Asociamos el archivo al proyecto.
			$user_project->files()->attach([
				$request->bom_file => ['use' => 'bom']
			]);
		} catch (Exception $e) {
			return redirect()->back()->withErrors([$e->getMessage()]);
		}

		return redirect()->route('user::projects.show', [
			'user' => $user,
			'user_project' => $user_project
		]);
	}

	// Upload dwgFile
	public function dwgFile(User $user, Project $user_project, UploadDwgRequest $request)
	{
		// Eliminamos el file asociado.
		$user_project->files()->wherePivot('use', 'dwg')->detach();

		try {
			// Asociamos el archivo al proyecto.
			$user_project->files()->attach([
				$request->dwg_file => ['use' => 'dwg']
			]);

		} catch (Exception $e) {
			return redirect()->back()->withErrors([$e->getMessage()]);
		}

		return redirect()->route('user::projects.show', [
			'user' => $user,
			'user_project' => $user_project
		]);
	}

	// Upload dataInputs
	public function data(User $user, Project $user_project, UploadDataRequest $request)
	{
		// Obtenemos la producción de este proyecto.
		$production = $user_project->production()->firstOrCreate([]);
		
		// Eliminamos el file asociado.
		$user_project->files()->wherePivot('use', 'data')->detach();

		// Guardamos la nueva información en data.
		$production->fill([
			'data' => $request->except(['_token', '_method', 'data_input']),
		]);
		$production->save();

		// Si no hay archivo damos de alta la informacion necesaria
		if ($request->option == 'file') {
		
			// Asociamos el archivo al proyecto.
			$user_project->files()->attach([
				$request->data_input => ['use' => 'data']
			]);

		}

		// Si todo sale bien llegamos hasta acá
		return redirect()->route('user::projects.show', [
			'user' => $user,
			'user_project' => $user_project
		]);
	}

	// Send project to quote.
	public function quote(User $user, Project $user_project, Request $request)
	{
		try {
			$user_project->next();
		} catch (Exception $e) {
			return redirect()->back()->withErrors([$e->getMessage()]);
		}

		return redirect()->route('user::projects.show', [
			'user' => $user,
			'user_project' => $user_project
		]);
	}

	public function route(User $user, Project $user_project, Request $request)
	{
		try {
			$user_project->next();

			// *Notification* project manager.
			$user_project->manager->notify(new ProjectNotification($user_project));

		} catch (Exception $e) {
			return redirect()->back()->withErrors([$e->getMessage()]);
		}

		return redirect()->route('user::projects.show', [
			'user' => $user,
			'user_project' => $user_project
		]);
	}

	public function dontRoute(User $user, Project $user_project, Request $request)
	{
		try {
			// Desasociamos el archivo con ese uso en este proyecto.
			$user_project->files()->wherePivot('use', 'placement')->detach();

			// Regresamos el proyecto al estado anterior.
			$user_project->before();

			// Notification project manager.
			$user_project->manager->notify(new ProjectNotification($user_project));

		} catch (Exception $e) {
			return redirect()->back()->withErrors([$e->getMessage()]);
		}

		return redirect()->route('user::projects.show', [
			'user' => $user,
			'user_project' => $user_project
		]);
	}

	public function errorReaded(User $user, Project $user_project, Request $request)
	{
		if (!is_null($user_project->error) && is_null($user_project->read_at)) {
			$user_project->read_at = Carbon::now();
			$user_project->save();
		}

		return response()->json([
			'message' => ['You have some errors.'],
			'success' => true
		]);
	}

	public function destroy(User $user, Project $user_project)
	{
		if(!$user_project->isDeletable) {
			return redirect()->back()->withErrors(["Project can't be deleted because is in \"" . $user_project->status->label . "\" status."]);
		}

		try {
			// Soft deletes para no tener que eliminar la relación con files y la relación de producción
			$user_project->delete();
		} catch (Exception $e) {
			return redirect()->back()->withErrors([$e->getMessage()]);
		}

		return redirect()->back()->withStatus('Project has been deleted successfully.');
	}

}
