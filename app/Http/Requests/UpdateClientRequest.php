<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'bail|required|alpha|max:255',
            'country_id' => 'bail|required|numeric',
            'identification_document_no' => 'bail|required|alpha_num',
            'email' => 'bail|nullable|email',
            'phone_no' => 'required',
            'date_of_first_reservation' => 'bail|date',
            'date_of_last_reservation' => 'bail|date|after_or_equal:date_of_first_reservation',
            'remarks' => 'nullable'
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Enter first name',
            'name.alpha' => 'Please enter only letters',
            'country_id.required' => 'Choose country',
            'identification_document_no.required' => 'Enter passport/ID number',
            'identification_document_no.alpha_num' => 'Enter only letters and digits with no spaces',
            'email.required' => 'Enter valid email',
            'phone_no.required' => 'Enter phone number',
            // 'date_of_first_reservation.required' => 'Enter date of first reservation',
            'date_of_first_reservation.date' => 'Enter valid date',
            // 'date_of_last_reservation.required' => 'Enter date of last reservation',
            'date_of_last_reservation.date' => 'Enter valid date',
            'date_of_last_reservation.after_or_equal:date_of_first_reservation' => 'Must be equal or later than first reservation date'
        ];
    }

}
