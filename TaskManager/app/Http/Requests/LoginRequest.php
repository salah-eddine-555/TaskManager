<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' =>  'required|email|max:255',
            'password'=> 'required|string|min:6|max:255',
        ];
    }

    public function messages(){
        return [
            'email.required'=> "email est oblegatoire",
            'email.email' => 'email invalide ',
            'email.string' => "email doit etre en format string",
            'password.min' => "password doit etre plus de 6 caractere",
        ];
    }

  
}
