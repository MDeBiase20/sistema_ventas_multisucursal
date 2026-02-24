<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsuarioRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'rol_id' => 'required|exists:roles,id',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre del usuario es obligatorio.',
            'email.required' => 'El correo electrónico del usuario es obligatorio.',
            'password.required' => 'La contraseña del usuario es obligatoria.',
            'rol_id.required' => 'El rol del usuario es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            //comparar la contraseña con la contraseña de confirmación
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ];
    }
}
