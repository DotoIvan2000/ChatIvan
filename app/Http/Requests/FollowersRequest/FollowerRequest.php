<?php

namespace App\Http\Requests\FollowersRequest;

use Illuminate\Foundation\Http\FormRequest;

class FollowerRequest extends FormRequest
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
            'followee_id' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'followee_id.required' => 'El id del usuario a seguir es requerido',
            'followee_id.integer' => 'El id del usuario a seguir debe ser un número entero',
        ];
    }
}
