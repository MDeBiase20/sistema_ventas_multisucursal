<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
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
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:500',
            'precio' => 'required|string|max:20',
            'codigo' => 'required|string|max:50|unique:productos,codigo',
            'proveedor_id' => 'required|exists:proveedors,id',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'precio.required' => 'El precio es obligatorio.',
            'codigo.required' => 'El código es obligatorio.',
            'codigo.unique' => 'El código ya existe. Por favor, elige otro.',
            'proveedor_id.required' => 'El proveedor es obligatorio.',
            'proveedor_id.exists' => 'El proveedor seleccionado no es válido.',
        ];
    }
}
