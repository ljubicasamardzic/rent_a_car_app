<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        
        $rules = [
            'country_id' => 'bail|required|numeric',
            'phone_no' => 'required',
            'date_of_first_reservation' => 'bail|required|date',
            'date_of_last_reservation' => 'bail|required|date|after_or_equal:date_of_first_reservation',
            'remarks' => 'nullable'
        ];

        // in case the client is created, these rules apply
        // first/last name was used instead of full name just for UX purposes
        if ($this->getMethod() == 'POST') {
            $rules += [
                'first_name' => 'bail|required|max:125',
                'last_name' => 'bail|required|max:125', 
                'identification_document_no' => 'bail|required|unique:clients,identification_document_no',
                'email' => 'bail|nullable|email|unique:clients,email'
            ];  

        // if updating, make this required
        } else if ($this->getMethod() == ('PATCH' || 'PUT')) {
            $rules['full_name'] = 'bail|required|max:255';
        }

        return $rules;

    }

    public function messages() {
        return [
            'first_name.required' => 'Enter first name',
            'last_name.required' => 'Enter last name',
            'country_id.required' => 'Choose country',
            'identification_document_no.required' => 'Enter passport/ID number',            'identification_document_no.unique:clients,identification_document_no' => 'Passport/ID number already exists in the database',
            'email.email' => 'Enter valid email',
            'email.unique:clients,email' => 'Email already exists in the database',
            'phone_no.required' => 'Enter phone number',
            'date_of_first_reservation.required' => 'Enter date of first reservation',
            'date_of_first_reservation.date' => 'Enter valid date',
            'date_of_last_reservation.required' => 'Enter date of last reservation',
            'date_of_last_reservation.date' => 'Enter valid date',
            'date_of_last_reservation.after_or_equal:date_of_first_reservation' => 'Must be equal or later than first reservation date'
        ];
    }

}
