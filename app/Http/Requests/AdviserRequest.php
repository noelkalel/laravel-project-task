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
            'first_name' => ['required', 'string', 'max:255', 'alpha'],
            'last_name'  => ['required', 'string', 'max:255', 'alpha'],
            'email'      => 'required_without:phone|nullable|email',
            'phone'      => 'required_without:email|nullable|numeric',
        ];
    }
}
