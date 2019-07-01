<?php 

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Projects\Project;

use App\Models\Users\User;

use App\Http\Requests\Users\Projects\PendingInfoRequest;

use App\Notifications\User\Projects\ProjectNotification;
use App\Notifications\User\Projects\ProjectReviewingNotification;

use App\Http\Requests\Users\Production\AltiumRequest;
use App\Http\Requests\Users\Production\GeometryRequest;
use App\Http\Requests\Users\Production\HighspeedRequest;
use App\Http\Requests\Users\Production\PowersupplyRequest;
use App\Http\Requests\Users\Production\RoutingRequest;
use App\Http\Requests\Users\Production\StackupRequest;

use Exception;

class UserProductionController extends Controller
{
	public function geometry(User $user, Project $user_project, GeometryRequest $request)
	{
		// Eliminamos el file asociado.
		$user_project->files()->wherePivot('use', 'dwg_')->detach();

		$route = route('user::projects.show', [
			'user' => $user,
			'user_project' => $user_project
		]);

		try {
			// Asociamos el archivo al proyecto.
			$user_project->files()->attach([
				$request->dwgFile => ['use' => 'dwg_']
			]);
		} catch (Exception $e) {
			return redirect()->to($route . '#geometry')->withErrors([$e->getMessage()]);
		}

		return redirect()->to($route . '#stackup')->withStatus('Geometry info saved succesfully.');
	}

	public function stackup(User $user, Project $user_project, StackupRequest $request)
	{
		// Obtenemos la producción de este proyecto.
		$production = $user_project->production()->firstOrCreate([]);

		// Eliminamos el file asociado.
		$user_project->files()->wherePivot('use', 'stackup')->detach();

		// Guardamos la nueva información en data.
		$production->fill([
			'stackup' => $request->except(['_token', '_method', 'stackup']),
		]);
		$production->save();

		// Si no hay archivo damos de alta la informacion necesaria
		if ($request->option == 'file') {
		
			// Asociamos el archivo al proyecto.
			$user_project->files()->attach([
				$request->stackup => ['use' => 'stackup']
			]);

		}

		$route = route('user::projects.show', [
			'user' => $user,
			'user_project' => $user_project
		]);

		// Si todo sale bien llegamos hasta acá
		return redirect()->to($route . '#routing')->withStatus('Stackup info saved succesfully.');
	}

	public function routing(User $user, Project $user_project, RoutingRequest $request)
	{
		// Obtenemos la producción de este proyecto.
		$production = $user_project->production()->firstOrCreate([]);

		// Eliminamos el file asociado.
		$user_project->files()->wherePivot('use', 'routing')->detach();

		// Guardamos la nueva información en data.
		$production->fill([
			'routing' => $request->except(['_token', '_method', 'routing']),
		]);
		$production->save();

		// Si no hay archivo damos de alta la informacion necesaria
		if ($request->option == 'file') {
		
			// Asociamos el archivo al proyecto.
			$user_project->files()->attach([
				$request->routing => ['use' => 'routing']
			]);

		}

		$route = route('user::projects.show', [
			'user' => $user,
			'user_project' => $user_project
		]);

		// Si todo sale bien llegamos hasta acá
		return redirect()->to($route . '#highspeed')->withStatus('Routing saved succesfully.');
	}

	public function highspeed(User $user, Project $user_project, HighspeedRequest $request)
	{
		// Obtenemos la producción de este proyecto.
		$production = $user_project->production()->firstOrCreate([]);

		// Guardamos la nueva información en data.
		$production->fill([
			'highspeed' => $request->except(['_token', '_method']),
		]);
		$production->save();

		$route = route('user::projects.show', [
			'user' => $user,
			'user_project' => $user_project
		]);

		// Si todo sale bien llegamos hasta acá
		return redirect()->to($route . '#power-supply')->withStatus('High speed saved succesfully.');
	}

	public function powerSupply(User $user, Project $user_project, PowersupplyRequest $request)
	{
		// Obtenemos la producción de este proyecto.
		$production = $user_project->production()->firstOrCreate([]);

		// Guardamos la nueva información en data.
		$production->fill([
			'power_supply' => $request->except(['_token', '_method']),
		]);
		$production->save();

		$route = route('user::projects.show', [
			'user' => $user,
			'user_project' => $user_project
		]);

		// Si todo sale bien llegamos hasta acá
		return redirect()->to($route . '#altium')->withStatus('Power supply saved succesfully.');
	}

	public function altium(User $user, Project $user_project, AltiumRequest $request)
	{
		// Eliminamos el file asociado.
		$user_project->files()->wherePivot('use', 'data')->detach();

		try {
			// Asociamos el archivo al proyecto.
			$user_project->files()->attach([
				$request->altium => ['use' => 'data']
			]);
		} catch (Exception $e) {
			return redirect()->back()->withErrors([$e->getMessage()]);
		}

		$route = route('user::projects.show', [
			'user' => $user,
			'user_project' => $user_project
		]);

		return redirect()->to($route . '#next')->withStatus('Altium and orcad saved succesfully.');
	}
	
	public function store(User $user, Project $user_project, Request $request)
	{
		try {

			// Se avanza al siguiente paso si todo esta correcto if save
			$user_project->next();

			// Notification user
			$user_project->user->notify(new ProjectNotification($user_project));
			
			// Notification project manager
			$user_project->manager->notify(new ProjectReviewingNotification($user_project));

		} catch (Exception $e) {
			return redirect()->back()->withErrors([$e->getMessage()]);
		}

		return redirect()->route('user::projects.show', [
			'user' => $user,
			'user_project' => $user_project
		]);
	}
}