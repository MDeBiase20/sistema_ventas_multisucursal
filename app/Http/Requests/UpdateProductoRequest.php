<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductoRequest extends FormRequest
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
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'codigo' => 'required|string|max:100|unique:productos,codigo,' . $this->producto->id,
            'proveedor_id' => 'required|exists:proveedors,id',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'precio.required' => 'El precio del producto es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'precio.min' => 'El precio no puede ser negativo.',
            'codigo.required' => 'El código del producto es obligatorio.',
            'codigo.unique' => 'El código del producto ya existe. Por favor, elige otro.',
            'proveedor_id.required' => 'El proveedor es obligatorio.',
            'proveedor_id.exists' => 'El proveedor seleccionado no existe.',
        ];
    }
}
