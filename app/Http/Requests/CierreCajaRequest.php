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
            'fecha_cierre' => 'required|date',
            'monto_final' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'fecha_cierre.required' => 'La fecha de cierre es obligatoria.',
            'fecha_cierre.date' => 'La fecha de cierre debe ser una fecha válida.',
            'monto_final.required' => 'El monto final es obligatorio.',
            'monto_final.numeric' => 'El monto final debe ser un número.',
            'monto_final.min' => 'El monto final no puede ser negativo.',
        ];
    }
}
