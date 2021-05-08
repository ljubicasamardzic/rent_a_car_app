<?php

namespace App\Http\Requests;

use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Http\FormRequest;

class VehicleRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'production_year' => 'bail|required|numeric|digits:4',
            'car_type' => 'bail|required|numeric',
            'number_of_seats' => 'bail|required|numeric|min:2|max:10',
            'price_per_day' => 'bail|required|numeric|min:1',
            'remarks' => 'nullable'
        ];

        // if ($this->getMethod() == 'POST') {
        //     $rules['plate_number'] = 'bail|required|unique:vehicles,plate_no';
        // }

        return $rules;
    }

    public function messages() 
    {
        return [
            'plate_no.required' => 'Enter plate numbers',
            'plate_no.unique:vehicles,plate_no' => 'A vehicle with these plate numbers already exists',
            'production_year.required' => 'Enter the production year',
            'production_year.numeric' => 'Enter digits only',
            'production_year.digits:4' => 'The production year must contain four digits',
            'car_type_id.required' => 'Choose car type',
            'car_type_id.numeric' => 'Choose car type',
            'no_of_seats.required' => 'Enter number of seats',
            'no_of_seats.numeric' => 'Enter digits only',
            'no_of_seats.min:2' => 'There must be at least 2 seats',
            'price_per_day.required' => 'Enter price per day',
            'price_per_day.numeric' => 'Enter digits only',
            'price_per_day.min:1' => 'Minimum price is 1€'
        ];
    }
}
