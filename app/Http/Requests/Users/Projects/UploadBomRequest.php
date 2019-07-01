<?php

namespace App\Http\Requests\Users\Projects;

use App\Http\Requests\Request;

class UploadBomRequest extends Request
{
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
        return [
            "bom_file" => 'required|exists:files,id',
        ];
    }
}
