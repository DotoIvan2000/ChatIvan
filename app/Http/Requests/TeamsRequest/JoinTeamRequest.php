<?php

namespace App\Http\Requests\TeamsRequest;

use Illuminate\Foundation\Http\FormRequest;

class JoinTeamRequest extends FormRequest
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
        ];
    }

    public function messages(): array
    {
        return [
            'team_id.required' => 'El equipo es requerido',
            'team_id.integer' => 'El equipo debe ser un número entero',
        ];
    }
}
