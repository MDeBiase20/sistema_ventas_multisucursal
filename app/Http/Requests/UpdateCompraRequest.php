<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompraRequest extends FormRequest
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
            'comprobante' => 'required|string|max:255',
            'fecha_compra' => 'required|date',
            'proveedor_id' => 'required|exists:proveedors,id',
            'sucursal_id' => 'required|exists:sucursals,id',
        ];
    }

    public function messages(): array
    {
        return [
            'comprobante.required' => 'El número de comprobante es obligatorio.',
            'comprobante.string' => 'El número de comprobante debe ser una cadena de texto.',
            'comprobante.max' => 'El número de comprobante no puede exceder los 255 caracteres.',
            'fecha_compra.required' => 'La fecha de compra es obligatoria.',
            'fecha_compra.date' => 'La fecha de compra debe ser una fecha válida.',
            'proveedor_id.required' => 'El proveedor es obligatorio.',
            'proveedor_id.exists' => 'El proveedor seleccionado no existe.',
            'sucursal_id.required' => 'La sucursal es obligatoria.',
            'sucursal_id.exists' => 'La sucursal seleccionada no existe.',
        ];
    }
}
