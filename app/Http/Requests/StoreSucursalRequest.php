<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSucursalRequest extends FormRequest
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
            'direccion' => 'required|string|max:500',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:sucursales,email',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre de la sucursal es obligatorio.',
            'direccion.required' => 'La dirección es obligatoria.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.unique' => 'El correo electrónico ya está en uso.',
        ];
    }
}
