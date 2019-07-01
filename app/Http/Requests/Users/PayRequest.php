<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\Request;

class PayRequest extends Request
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
        $rules = [
            'payment_method' => 'required',
        ];

        if ($this->payment_method == 'stripe') {
            if ($this->has('new_card')) {
                $rules['new_card'] = 'required';
                $rules['token'] = 'required';
            }else {
                $rules['card_id'] = 'required';
            }
        }elseif ($this->payment_method == 'purchase_order') {
            $rules['purchase_order'] = 'required|exists:files,id';
        }

        return $rules;
    }
}
