<?php

namespace App\Http\Requests;
use App\Models\Equipment;
use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return $rules = [
            'client_id' => 'bail|required|integer',
            'vehicle_id' => 'bail|required|integer',
            'rent_date' => 'bail|required|date',
            'return_date' => 'bail|required|date|after:rent_date',
            'rent_location' => 'bail|required|integer', 
            'return_location' => 'bail|required|integer'
        ];

        // if there is equipment, make sure that its quantity does not exceed
        // the maximum quantity for each type of item

        // if ($this->request->get('equipment') != null) {
        //     foreach($this->request->get('equipment') as $key => $val)
        //     {
        //         $max = Equipment::find($key)->max_quantity;
        //         $rules['equipment.'.$key] = 'max:' .$max .'|integer';
        //     }
        // }
        // return $rules;
    }
   

    public function messages() {
        return $messages = [
            'client_id.required' => 'Enter client',
            'vehicle_id.required' => 'Enter vehicle',
            'rent_date.required' => 'Enter start date',
            'return_date.required' => 'Enter return date',
            'return_date.after:rent_date' => 'Return date must be later than start date'
        ];

        // if ($this->request->get('equipment') != null) {
        //    foreach($this->request->get('equipment') as $key => $val)
        //     {
        //         $messages['equipment.'.$key.'.max'] = 'The quantity must be smaller or equal to :max.';
        //     } 
        // }

        // return $messages;
    }
}
