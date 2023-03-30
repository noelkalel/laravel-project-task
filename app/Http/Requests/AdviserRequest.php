<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdviserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required_without:phone|nullable|email',
            'phone'      => 'required_without:email|nullable',
        ];
    }
}
