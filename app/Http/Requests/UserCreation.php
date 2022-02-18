<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

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
            'names' => 'required|string',
            'mobile' => 'required|unique:users,mobile',
            'password' => 'required|min:6|max:25'
        ];
    }

    public function messages()
    {
        return [
            'names.required' => 'Името е задължително',
            'mobile.required' => 'Телефонът е задължителен',
            'mobile.unique' => 'Телефонът е вече регистриран',
            'password.required' => 'Паролата е задължителна',
            'password.min' => 'Паролата трябва да бъде минимум 6 символа',
            'password.max' => 'Паролата трябва да бъде максимум 25 символа'
        ];
    }
}
