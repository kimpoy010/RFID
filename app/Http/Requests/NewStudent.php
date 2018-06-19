<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewStudent extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|unique:users',
            'contact_number' => 'required|max:11',
            'first_name' => 'required',
            'bday' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'guardian_name' => 'required',
            'address' => 'required',
            'level' => 'required',
            'section' => 'required'
        ];
    }
}
