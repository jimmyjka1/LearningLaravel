<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
            'first_name' => "required|regex:/^[A-Za-z\s]+$/u|max:255",
            'last_name' => "required|regex:/^[A-Za-z\s]+$/u|max:255",
            'email' => 'required|email|max:255',
            'phone' => 'required|digits_between:10,12',
            'password' => 'required|regex:/^.*[A-Z]+.*$/u|regex:/^.*[a-z]+.*$/u|regex:/^.*\d+.*$/u|regex:/^.*[@~`!#$%^&*()_\-+={}\[\]<>?"]+.*$/u|min:6',
            'gender' => 'required',
            'cast' => 'required',
            'image_file' => 'required|mimes:jpg,jpeg,png|max:2048'
        ];
    }


    public function messages()
    {
        return [
            'password.regex' => 'Password should contain atleast one capital letter, one digit, one small letter and one special character.'
        ];
    }


}
