<?php

namespace App\Http\Requests\Users\Archives\Photos;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

use App\Models\Photo;

class SortPhotoRequest extends Request
{
	public function __construct(\Illuminate\Http\Request $request)
    {
        $input = $request->request->all();
        $request->request->add(['photos_associated' => isset($input["photos"]) ?$input["photos"] : []  ]);
        parent::__construct($request);
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $input = $this->all();

        $photoable_id   = isset($input["photoable_id"]) ? $input["photoable_id"] : "0" ;
        $photoable_type = isset($input["photoable_type"]) ? $input["photoable_type"] : "0";

        $use = isset($input["use"]) ? $input["use"] : "0";

        $rules = [
            "photoable_type"    	=>[
				"required",
				"in:".implode(",",Photo::$create_associable_models),
				"in:".Photo::getImpodeCodesToAssociateModels()
			],
            "photoable_id"          => ["required"],
            "photos"                => "required|array",
            "photos.*"              => "required|exists:photos,id",
            "use"                   => "required",
        ];

        if ( in_array($photoable_type, Photo::$create_associable_models) ) {

            $table_name = Photo::getTableOfAssociateModelForCode($input["photoable_type"]);

			if ($table_name) {
				$exists_rule = Rule::exists($table_name,'id');
				$user = $this->user;
				switch ($input["photoable_type"]) {
					case 'news':
						$exists_rule = $exists_rule->where(function ($query) use ($user) {
		                    return $query->where(['user_id' => $user->id,])->whereNull("sent_at");
		                });
						break;
				}

                $rules["photoable_id"][] = $exists_rule;
            }

            $photoable_class = Photo::$associable_models[$photoable_type];
            $rules['use'] .= '|in:' . implode(',', $photoable_class::$image_galleries);

			$photo_photoable_table = (new $photoable_class)->photos()->getTable();
			$photoable_id_col = str_replace($photo_photoable_table.".", "", (new $photoable_class)->photos()->getForeignKey() );

			$rules["photos_associated.*"] = Rule::exists($photo_photoable_table,'photo_id')
				->where(function ($query) use ($photoable_id_col,$photoable_id,$use ) {
					return $query->where([
						$photoable_id_col 	=> $photoable_id,
						"use"				=> $use
					]);
				});

        }
        return $rules;
    }
}
