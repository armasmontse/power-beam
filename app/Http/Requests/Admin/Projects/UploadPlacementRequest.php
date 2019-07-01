<?php

namespace App\Http\Requests\Admin\Projects;

use App\Http\Requests\Request;

class UploadPlacementRequest extends Request
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
            // "quoteFile" => 'required|exists:files,id',
            "placementFile" => 'required',
        ];
    }
}
