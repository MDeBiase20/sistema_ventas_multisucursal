<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CierreCajaRequest extends FormRequest
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
            'monto_efectivo' => 'nullable|numeric|min:0',
            'monto_transferencia' => 'nullable|numeric|min:0',
            'monto_otros' => 'nullable|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'monto_efectivo.numeric' => 'El monto en efectivo debe ser un número.',
            'monto_efectivo.min' => 'El monto en efectivo no puede ser negativo.',
            'monto_transferencia.numeric' => 'El monto de transferencia debe ser un número.',
            'monto_transferencia.min' => 'El monto de transferencia no puede ser negativo.',
            'monto_otros.numeric' => 'El monto de otros debe ser un número.',
            'monto_otros.min' => 'El monto de otros no puede ser negativo.',
        ];
    }
}
