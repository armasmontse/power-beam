<?php

namespace App\Http\Controllers\Users\Files;

use Storage;
use Exception;
use Illuminate\Http\Request;
use App\Models\Projects\Project;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UploadFiles;
use App\Http\Requests\Users\Files\CreateFileRequest;
use App\Models\File;

class UserFilesController extends ClientController
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

	public function store(CreateFileRequest $request)
	{
		try {

			return response()->json([
				'file' => $this->uploadFile($request->file('file'), 'projects')
			]);

		} catch (Exception $e) {

			return response()->json([
				'messages' => [$e->getMessage()]
			], 422);

		}
	}

	public function show(File $file)
	{
		return $this->showFile($file);
	}
}
