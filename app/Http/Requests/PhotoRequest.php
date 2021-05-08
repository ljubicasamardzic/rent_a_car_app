<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhotoRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'photo' => 'nullable',
            'photo.*' => 'mimes:jpeg,png,jpg,gif,svg'
        ];
    }

    public function messages()
    {
        return [
            'photo.*.mimes' => 'Image must be of type jpg, jpeg, png, bmp, gif, svg, and webp' 
        ];
    }
}
