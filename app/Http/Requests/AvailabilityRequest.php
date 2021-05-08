<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvailabilityRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'car_type_id' => 'nullable',
            'from_date' => 'bail|required|date',
            'to_date' => 'bail|required|date|after:from_date'
        ];
    }
}
