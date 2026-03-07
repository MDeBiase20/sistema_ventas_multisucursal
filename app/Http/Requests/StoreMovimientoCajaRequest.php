<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovimientoCajaRequest extends FormRequest
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
            'tipo_movimiento' => 'required|in:ingreso,egreso',
            'monto' => 'required|numeric|min:0',
            'descripcion' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'tipo_movimiento.required' => 'El tipo de movimiento es obligatorio.',
            'tipo_movimiento.in' => 'El tipo de movimiento debe ser ingreso o egreso.',
            'monto.required' => 'El monto es obligatorio.',
            'monto.numeric' => 'El monto debe ser un número.',
            'monto.min' => 'El monto debe ser al menos 0.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',
            'descripcion.max' => 'La descripción no puede exceder los 255 caracteres.',
        ];
    }
}
