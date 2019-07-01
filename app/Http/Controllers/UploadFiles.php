<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\UploadedFile;
use App\Models\File;
use Symfony\Component\HttpFoundation\StreamedResponse;

trait UploadFiles
{
	/**
	 * 
	 */
	protected $disk;

	/**
	 * 
	 */
	protected $filesystem;


	public function uploadFile(UploadedFile $inputFile, $path = '')
	{
		// Subimos y guardamos el archivo en el servidor.
		$path = $this->disk->putFile($path, $inputFile);

		$file = File::where('path', $path)->first();

		// Revisamos si ese archivo ha sido subido anteriormenete.
		if (!$file) {

			// Intentamos guardar el archivo en la base de datos.
			$file = File::create([
				'path' => $path,
				'name' => $inputFile->getClientOriginalName()
			]);
		}

		// Devolvemos el response con el objeto file.
		return $file;
	}

	public function showFile(File $file)
	{
		return $this->download($file->path, $file->name, []);
	}

	public function download($path, $name = null, array $headers = [])
    {
        return $this->response($path, $name, $headers, 'attachment');
    }

	public function response($path, $name = null, array $headers = [], $disposition = 'inline', $disk = null)
    {
        $response = new StreamedResponse;
        $disposition = $response->headers->makeDisposition($disposition, $name ?? basename($path));
        $response->headers->replace($headers + [
            'Content-Type' => $this->disk->mimeType($path),
            'Content-Length' => $this->disk->size($path),
            'Content-Disposition' => $disposition,
        ]);
        $response->setCallback(function () use ($path) {
            $stream = $this->disk->readStream($path);
            fpassthru($stream);
            fclose($stream);
        });
        return $response;
	}
}
