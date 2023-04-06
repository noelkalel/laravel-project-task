<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeLoanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'property_value'      => 'required|numeric',
            'down_payment_amount' => 'required|numeric',
        ];
    }
}
