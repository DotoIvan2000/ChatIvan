<?php

namespace App\Http\Requests\MessagesRequest;

use Illuminate\Foundation\Http\FormRequest;

class TeamMessageRequest extends FormRequest
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
            'team_id' => 'required|integer',
            'emisor_id' => 'required|integer',
            'message' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'team_id.required' => 'El equipo es requerido',
            'team_id.integer' => 'El equipo debe ser un número entero',
            'emisor_id.required' => 'El emisor es requerido',
            'emisor_id.integer' => 'El emisor debe ser un número entero',
            'message.required' => 'El mensaje es requerido',
        ];
    }
}
