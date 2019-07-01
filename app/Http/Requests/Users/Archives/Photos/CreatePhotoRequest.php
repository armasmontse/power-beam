<?php

namespace App\Http\Requests\Users\Archives\Photos;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

use App\Models\Photo;

class CreatePhotoRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
		$input = $this->all();

        $rules = [
            "photoable_type"    => [
				"required",
				"in:".implode(",",Photo::$create_associable_models),
				"in:".Photo::getImpodeCodesToAssociateModels()
			],
            "photoable_id"      => ["required"],
            "image"             => "required|image|max:2048",
			"use"               => "required",
        ];

        if (isset($input["photoable_type"]) && in_array($input["photoable_type"], Photo::$create_associable_models)  ) {

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

			if(isset(Photo::$associable_models[$input["photoable_type"]]))
			{
				$photoable_class = Photo::$associable_models[$input["photoable_type"]];
				$rules['use'] .= '|in:' . implode(',', $photoable_class::$image_uses);
			}
        }

        return $rules;
    }

}
