<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class RuleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'expired_date'=>'required',
            'delivery_type' => 'required',
            'route' => 'required',
            'weight' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'expired_date.required'=>'Please Enter Expire Date',
            'delivery_type.required'=>'Please Select Delivery Type',
            'route.required'=>'Please Select Route',
            'weight.required'=>'Please Enter Weight',
        ];
    }
}
