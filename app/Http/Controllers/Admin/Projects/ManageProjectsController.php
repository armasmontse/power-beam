<?php

namespace App\Http\Controllers\Admin\Projects;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UploadFiles;

use App\Models\File;

use App\Models\Users\User;

use App\Models\Projects\Project;
use App\Models\Projects\Note;
use App\Models\Projects\Quote;
use App\Models\Projects\Status;

use App\Http\Requests\Admin\Projects\ErrorRequest;
use App\Http\Requests\Admin\Projects\AddNoteRequest;
use App\Http\Requests\Admin\Projects\UploadQuoteRequest;
use App\Http\Requests\Admin\Projects\UploadOutputRequest;
use App\Http\Requests\Admin\Projects\UploadPlacementRequest;
use App\Http\Requests\Admin\Projects\AssignManagerRequest;

use App\Notifications\User\Projects\ProjectNotification;
use App\Notifications\ProjectAssignedNotification;
use App\Notifications\ProjectManagerAssignedNotification;

use Storage;
use Exception;
use ZipArchive;

class ManageProjectsController extends Controller
{
	use UploadFiles;

	public function __construct()
	{
		parent::__construct();

		// Filesystem que se va a usar (default o cloud).
		$default = config('app.filesystem_disk');
		$this->filesystem = config('filesystems.' . $default);
		$this->disk = Storage::disk($this->filesystem);
	}

    public function index()
    {
		$projects = Project::with([
			'manager',
			'user',
			'status'
		])
		->get()
		->sortByDesc('updated_at')
		->sortBy('status.order')
		->values();

        $data = [
            'projects' => $projects
        ];

        return view('admin.projects.index', $data);
    }

    public function edit(Project $projects_admin)
    {
		$data = [
			'project' => $projects_admin,
			'managers' => User::whereHasPermission('manage_projects')->get()
		];

        return view('admin.projects.edit', $data);
    }

    public function show(Project $projects_admin)
    {
    	$projects_admin->production()->firstOrCreate([]);

    	$data = [
    		'project' => $projects_admin->load('status', 'user', 'manager', 'files', 'production', 'quotes', 'notes')
    	];

    	return view('admin.projects.show', $data);
    }

    public function take(Project $projects_admin, AssignManagerRequest $request)
    {
		$sendNotification = $projects_admin->manager_id != $request->manager_id;

		if(!$sendNotification) {
			return redirect()->back()->withErrors(['The project manager was previously set, change the user to update the PM.']);
		}

        try{

        	// Asignamos el usuario actual al proyecto.
	        $projects_admin->manager()->associate($request->manager_id);
			$projects_admin->save();

			// Notificamos al project manager
			$projects_admin->manager->notify(new ProjectAssignedNotification($projects_admin));

			// Notificamos al dueño del proyecto de la asignación.
            $projects_admin->user->notify(new ProjectManagerAssignedNotification($projects_admin));

        }catch(Exception $e){
        	// Regresamos en cado de algún error.
            return redirect()->back()->withErrors([$e->getMessage()]);
		}

        return redirect()->route('admin::projects.edit', $projects_admin->id)->with('status', trans('manage_projects.take.success'));
    }

    public function addNote(Project $projects_admin, AddNoteRequest $request)
    {
        try{
        	// Agregamos una nota al proyecto.
        	$projects_admin->notes()->create([
				'message' => $request->note,
				'user_id' => $this->user->id
			]);
        	// Falta notificación de que se creó una nota.
        }catch(Exception $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }

        return redirect()->route('admin::projects.edit', $projects_admin->id)->with('status', trans('manage_projects.addNote.success'));
    }

    public function next(Project $projects_admin)
    {
        try{
        	// Enviamos el proyecto al siguiente paso.
            $projects_admin->next();
            // Notificamos al usuario que se cambio el status del proyecto.
            $projects_admin->user->notify(new ProjectNotification($projects_admin));
        }catch(Exception $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }

        return redirect()->route('admin::projects.edit', $projects_admin->id)->with('status', trans('manage_projects.next.success'));
    }

    public function error(Project $projects_admin, ErrorRequest $request)
    {
        try{
        	// Asignamos el error al proyecto.
            $projects_admin->fill([
            	'error' => $request->error,
            	'read_at' => null,
            ]);
            $projects_admin->save();

            // Borramos los archivos que haya subido.
            $projects_admin->files()->detach();

            // Enviamos el proyecto al estatus inicial.
            $status = Status::all()->first();
            $projects_admin->go($status);

            // Notificamos al usuario que se cambio el status del proyecto.
            $projects_admin->user->notify(new ProjectNotification($projects_admin));

        }catch(Exception $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
        return redirect()->route('admin::projects.edit', $projects_admin->id)->with('status', trans('manage_projects.error.success'));
    }

    // Upload quote File
    public function quoteFile(User $user, Project $projects_admin, UploadQuoteRequest $request)
    {
        try {
			$file = $this->uploadFile($request->file('quoteFile'), 'quotes');

            // Creamos el quote para ese proyecto con ese archivo.
            $projects_admin->quotes()->create([
            	'file_id' => $file->id,
            	'amount' => floatval($request->amount) * 100,
            ]);

            // Cambiamos el estatus al siguiente.
            $projects_admin->next();

            // Notificamos al usuario que se cambio el status del proyecto.
            $projects_admin->user->notify(new ProjectNotification($projects_admin));

		} catch (Exception $e) {
            // Regresamos un response con error.
			return redirect()->back()->withErrors([$e->getMessage()]);
		}
		
        return redirect()->route('admin::projects.edit', $projects_admin->id)->with('status', trans('manage_projects.quote.success'));
    }

    // Upload output File
    public function outputFile(Project $projects_admin, UploadOutputRequest $request)
    {
        try {
			
			$file = $this->uploadFile($request->file('outputFile'), 'outputs');
            
            // Creamos el output para ese proyecto con ese archivo.
            $projects_admin->files()->attach([
    			$file->id => ['use' => 'output']
    		]);

            // Cambiamos el estatus.
            $projects_admin->next();

            // *Notification* user
            $projects_admin->user->notify(new ProjectNotification($projects_admin));

		} catch (Exception $e) {
            // Regresamos un response con error.
            return redirect()->back()->withErrors([$e->getMessage()]);
		}


        return redirect()->route('admin::projects.edit', $projects_admin->id)->with('status', trans('manage_projects.output.success'));
    }

    // Upload placement File
    public function placementFile(User $user, Project $projects_admin, UploadPlacementRequest $request)
    {
        try {
			
			$file = $this->uploadFile($request->file('placementFile'), 'placement');

            // Creamos el output para ese proyecto con ese archivo.
            $projects_admin->files()->attach([
    			$file->id => ['use' => 'placement']
    		]);

            // Cambiamos el estatus.
            $projects_admin->next();

            // *Notification* user
            $projects_admin->user->notify(new ProjectNotification($projects_admin));

		} catch (Exception $e) {
            // Regresamos un response con error.
			return redirect()->back()->withErrors([$e->getMessage()]);
		}

        return redirect()->route('admin::projects.edit', $projects_admin->id)->with('status', trans('manage_projects.placement.success'));
	}
	
	public function downloadFiles(User $user, Project $projects_admin)
	{
		if($projects_admin->files->isEmpty()){
			return redirect()->back()->withErrors(['There are no files associated with this project.']);
		}

		$basename = str_slug(config('app.name')) . '-' . $projects_admin->slug . '-' . str_random(5) . '.zip';
		
		$tmppath = storage_path('app/tmp/');

		// Generamos el nombre del archivo.
		$filename = $tmppath . $basename;

		// Nombre de los archivos temporales
		$files = [];

		// Instancia de Zip
		$zip = new ZipArchive;

		$code = $zip->open($filename, ZipArchive::CREATE);

		// Creamos el archivo zip.
		if($code !== true){
			return redirect()->back()->withErrors(['We could not generate the file at this time, try again later.']);
		}

		try {

			foreach($projects_admin->files as $file){

				// Obtenemos el stream.
				$stream = $this->disk->readStream($file->path);
	
				// Generamos un nombre temporal para el archivo.
				$tpmname = $files[] = $tmppath . uniqid();

				createWritableFile($tpmname);
	
				// Abrimos el archivo
				$destination = fopen($tpmname, 'w');
				
				// Escribimos en el archivo.
				while (!feof($stream)) {
					fwrite($destination, fread($stream, 8192));
				}
	
				fclose($stream);
				fclose($destination);
	
				// Agregamos al zip.
				$zip->addFile($tpmname, $file->pivot->use . '.' . $file->extension());
	
			}

		}catch(Exception $e){
			return redirect()->back()->withErrors(['We could not generate the file at this time, try again later.']);
		}

		$zip->close();

		// Borramos archivos temporales.
		foreach($files as $file){

			unlink($file);

		}

		return response()->download($filename)->deleteFileAfterSend(true);
	}

}
