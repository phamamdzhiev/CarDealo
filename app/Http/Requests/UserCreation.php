<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreation extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'mobile' => 'required',
            'password' => 'required|min:6|max:25'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Името е задължително',
            'email.required' => 'Имейлът е задължителен',
            'email.email' => 'Въведете валиден имейл',
            'email.unique' => 'Имейлът е вече е регистриран',
            'mobile.required' => 'Телефонът е задължителен',
            'password.required' => 'Паролата е задължителна',
            'password.min' => 'Паролата трябва да бъде минимум 6 символа',
            'password.max' => 'Паролата трябва да бъде максимум 25 символа'
        ];
    }
}
