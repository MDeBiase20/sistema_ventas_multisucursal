<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompraRequest extends FormRequest
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
            // Define your validation rules here
            'comprobante' => 'required|string|max:255',
            'fecha_compra' => 'required|date',
            'proveedor_id' => 'required|exists:proveedors,id',
            'precio_total' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'comprobante.required' => 'El comprobante es obligatorio.',
            'comprobante.string' => 'El comprobante debe ser una cadena de texto.',
            'comprobante.max' => 'El comprobante no puede exceder los 255 caracteres.',
            'fecha_compra.required' => 'La fecha de compra es obligatoria.',
            'fecha_compra.date' => 'La fecha de compra debe ser una fecha válida.',
            'proveedor_id.required' => 'El proveedor es obligatorio.',
            'proveedor_id.exists' => 'El proveedor seleccionado no existe.',
            'precio_total.required' => 'El precio total es obligatorio.',
            'precio_total.numeric' => 'El precio total debe ser un número.',
            'precio_total.min' => 'El precio total no puede ser negativo.',
        ];
    }
}
