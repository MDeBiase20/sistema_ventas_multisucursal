<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVentaRequest extends FormRequest
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
                'fecha_venta' => 'required|date',
                'cliente_id' => 'nullable|exists:clientes,id',
                'precio_total' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'fecha_venta.required' => 'La fecha de venta es obligatoria.',
            'fecha_venta.date' => 'La fecha de venta debe ser una fecha válida.',
            'cliente_id.exists' => 'El cliente seleccionado no existe.',
            'precio_total.required' => 'El precio total de la venta es obligatorio.',
            'precio_total.numeric' => 'El precio total debe ser un número.',
            'precio_total.min' => 'El precio total no puede ser negativo.',
        ];
    }
}
