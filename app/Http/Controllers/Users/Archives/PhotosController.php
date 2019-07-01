<?php

namespace App\Http\Controllers\Users\Archives;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Photo;
use App\Models\Users\User;

use App\Http\Requests\Users\Archives\Photos\CreatePhotoRequest;
use App\Http\Requests\Users\Archives\Photos\SortPhotoRequest;
use App\Http\Requests\Users\Archives\Photos\DisassociatePhotoRequest;

use Response;
use Exception;

class PhotosController extends Controller
{
    public function store(CreatePhotoRequest $request,User $user)
    {
		$input = $request->all();

		$photoable_class = Photo::$associable_models[$input["photoable_type"]];

		$photoable = $photoable_class::find($input["photoable_id"]);

		$newImage = Photo::createImageFile($input["image"]);

        if (!$newImage) {
            return Response::json([
                'error' => [trans('photos.create.file.error')]
            ], 422);
        }

		$photo = Photo::getPhotoCollectionByFileName($newImage)->first();

        if (!$photo) {
			$photo = Photo::create([
				"filename"  => $newImage,
				"type"      => $input["image"]->getMimeType(),
			]);
        }

		if (!$photo) {
			Storage::delete($file_path);
			Storage::delete(str_replace(Photo::STORAGE_PATH, Photo::THUMBNAILS_STORAGE_PATH, $file_path)  );
			return Response::json([
				'error' => [trans('photos.create.database.error')]
			], 422);
		}

		if ($photoable->cantUsePhotoFor($photo,$input["use"]) ) {
			return Response::json([
				'error' => [trans('photos.create.cantuse')]
			], 422);
		}

		$is_gallery = in_array($input['use'], $photoable_class::$image_galleries);


		if (!in_array($input['use'], $photoable_class::$image_galleries)) { //si no es galleria borramos la anterior

			$previous_image = $photoable->getFirstPhotoTo(["use"=> $input["use"]]);

			if ($previous_image) {

				if (!$photoable->disassociateImage($previous_image, [
					"use"=> $input["use"]
				])) {
					return Response::json([
						'error' => [trans('photos.create.disassociate.error')]
					], 422);
				}

			}
		}

        if (!$photoable->associateImage($photo, [
			"use"=> $input["use"]
		])) {
            return Response::json([
                'error' => [trans('photos.create.associate.error')]
            ], 422);
        }

        return Response::json([ // todo bien
			'data'      => $photo,
            'message' => [trans('photos.create.associate.success')],
            'success' => true
        ]);
    }

    public function sort(sortPhotoRequest $request,User $user, Photo $Photo)
    {
		$input = $request->all();
		$photoable_class = Photo::$associable_models[$input["photoable_type"]];
		$photoable = $photoable_class::find($input["photoable_id"]);

		$photos =  $photoable->getPhotosTo(["use" => $input["use"]]);

		foreach ($photos as $photo) {
			$photoable->photos()
				->wherePivot('use', $input["use"])
				->updateExistingPivot($photo->id, ["order" => null]);
		}

		foreach ($input["photos"] as $photo_new_order => $photo_id) {
			$photoable->photos()
				->wherePivot('use', $input["use"])
				->updateExistingPivot($photo_id, ["order" => $photo_new_order ]);
		}

		return Response::json([ // todo bien
			"data"    => $photoable->load("photos")->getPhotosTo(["use" => $input["use"]]) ,
			'message' => [trans('photos.sort.success')],
			'success' => true
		]);
    }

	public function disassociate(DisassociatePhotoRequest $request,User $user, Photo $photo)
	{

		$input = $request->all();
		$photoable_class = Photo::$associable_models[$input["photoable_type"]];
		$photoable = $photoable_class::find($input["photoable_id"]);
		$use_order_class = [
			"use"   => $input["use"],
		];

		if (!$photoable->cantUsePhotoFor($photo,$input["use"]) ) {
			return Response::json([
				'error' => [trans('photos.disassociate.not_use')]
			], 422);
		}

		if (!$photoable->disassociateImage($photo,$use_order_class)) {
			return Response::json([
				'error' => [trans('photos.disassociate.error')]
			], 422);
		}

		return Response::json([ // todo bien
			'message' => [trans('photos.disassociate.success')],
			'success' => true
		]);
	}


}
