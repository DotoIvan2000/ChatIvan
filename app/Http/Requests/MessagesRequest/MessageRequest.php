<?php

namespace App\Http\Requests\MessagesRequest;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
            'receptor_id' => 'required|integer',
            'message' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'receptor_id.required' => 'El receptor es requerido',
            'receptor_id.integer' => 'El receptor debe ser un número entero',
            'message.required' => 'El mensaje es requerido',
        ];
    }
}
