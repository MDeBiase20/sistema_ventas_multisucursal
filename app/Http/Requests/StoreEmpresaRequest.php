<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmpresaRequest extends FormRequest
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
            'pais_id' => 'required|exists:countries,id',
            'ciudad_id' => 'required|exists:cities,id',
            'departamento_id' => 'required|exists:states,id',
            'tipo_empresa' => 'required',
            'direccion' => 'required|string|max:500',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:empresas,email',
            'cuit' => 'required|string|max:50|unique:empresas,cuit',
            'impuesto' => 'required',
            'nombre_impuesto' => 'required|string|max:100',
            'moneda_id' => 'required|exists:currencies,id',
            'codigo_postal' => 'required|string|max:10',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre de la empresa es obligatorio.',
            'pais.required' => 'El país es obligatorio.',
            'ciudad.required' => 'La ciudad es obligatoria.',
            'departamento.required' => 'El departamento o localidad es obligatorio.',
            'tipo_empresa.required' => 'El tipo de empresa es obligatorio.',
            'direccion.required' => 'La dirección es obligatoria.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'cuit.required' => 'El CUIT es obligatorio.',
            'cuit.unique' => 'El CUIT ya está en uso.',
            'impuesto.required' => 'El impuesto es obligatorio.',
            'nombre_impuesto.required' => 'El nombre del impuesto es obligatorio.',
            'moneda.required' => 'La moneda es obligatoria.',
            'codigo_postal.required' => 'El código postal es obligatorio.',
            'logo.image' => 'El logo debe ser una imagen válida.',
            'logo.mimes' => 'El logo de la empresa debe ser un archivo de tipo: jpeg, png, jpg, gif, svg.',
            'logo.max' => 'El logo de la empresa no debe superar los 2MB.',
        ];
    }
}
