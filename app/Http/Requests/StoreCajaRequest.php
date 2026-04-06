<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCajaRequest extends FormRequest
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
            'fecha_apertura' => 'required|date',
            'monto_inicial' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'fecha_apertura.required' => 'La fecha de apertura es obligatoria.',
            'fecha_apertura.date' => 'La fecha de apertura debe ser una fecha válida.',
            'monto_inicial.required' => 'El monto inicial es obligatorio.',
            'monto_inicial.numeric' => 'El monto inicial debe ser un número.',
            'monto_inicial.min' => 'El monto inicial no puede ser negativo.',
        ];
    }
}
