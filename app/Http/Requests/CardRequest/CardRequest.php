<?php

namespace App\Http\Requests\CardRequest;

use Illuminate\Foundation\Http\FormRequest;

class CardRequest extends FormRequest
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
            'type_id' => 'required|int',
            'card_number' => 'required|string|size:16',
            'date' => 'required|string',
            'cvv' => 'required|string|size:3',
        ];
    }

    public function messages(): array
    {
        return [
            'type_id.required' => 'El tipo de tarjeta es requerido',
            'card_number.required' => 'El número de tarjeta es requerido',
            'date.required' => 'La fecha de expiración es requerida',
            'cvv.required' => 'El código de seguridad es requerido',
            'card_number.size' => 'El número de tarjeta debe tener 16 dígitos',
            'cvv.size' => 'El código de seguridad debe tener 3 dígitos',
        ];
    }
}
