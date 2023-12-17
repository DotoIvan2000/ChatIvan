<?php

namespace App\Http\Requests\AuthRequest;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|confirmed|min:8|max:255',
            'type_id' => 'required|integer|exists:types,id',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'El campo nombre es requerido',
            'first_name.string' => 'El campo nombre debe ser una cadena de texto',
            'first_name.max' => 'El campo nombre debe tener un máximo de 255 caracteres',
            'last_name.required' => 'El campo apellido es requerido',
            'last_name.string' => 'El campo apellido debe ser una cadena de texto',
            'last_name.max' => 'El campo apellido debe tener un máximo de 255 caracteres',
            'username.required' => 'El campo usuario es requerido',
            'username.string' => 'El campo usuario debe ser una cadena de texto',
            'username.max' => 'El campo usuario debe tener un máximo de 255 caracteres',
            'username.unique' => 'El campo usuario ya existe',
            'email.required' => 'El campo correo electrónico es requerido',
            'email.string' => 'El campo correo electrónico debe ser una cadena de texto',
            'email.email' => 'El campo correo electrónico debe ser un correo electrónico válido',
            'email.max' => 'El campo correo electrónico debe tener un máximo de 255 caracteres',
            'email.unique' => 'El campo correo electrónico ya existe',
            'password.required' => 'El campo contraseña es requerido',
            'password.string' => 'El campo contraseña debe ser una cadena de texto',
            'password.confirmed' => 'El campo contraseña no coincide con el campo confirmar contraseña',
            'password.min' => 'El campo contraseña debe tener un mínimo de 8 caracteres',
            'password.max' => 'El campo contraseña debe tener un máximo de 255 caracteres',
            'type_id.required' => 'El campo tipo de usuario es requerido',
            'type_id.integer' => 'El campo tipo de usuario debe ser un número entero',
            'type_id.exists' => 'El campo tipo de usuario no existe',
        ];
    }
}
