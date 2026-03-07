<?php

namespace App\Services;

use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClienteService
{

    /**
     * Preparar datos para el cliente
     */
    public function CrearCliente(array $data)
    {
        return DB::transaction(function () use ($data) {

            $cliente = Cliente::create([
                'nombre' => $data['nombre'],
                'apellido' => $data['apellido'],
                'email' => $data['email'],
                'telefono' => $data['telefono'],
                'direccion' => $data['direccion'],
                'empresa_id' => Auth::user()->empresa_id,
            ]);

            return $cliente;
        });
    }

    public function mostrarCliente(Cliente $cliente)
    {
        return $cliente->load('empresa');

    }

    public function ActualizarCliente(Cliente $cliente, array $data): Cliente
    {
        $update = [
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'email' => $data['email'],
            'telefono' => $data['telefono'],
            'direccion' => $data['direccion'],
        ];

        $cliente->update($update);

        return $cliente;
    }

    public function eliminarCliente(Cliente $id): void
    {
        DB::transaction(function () use ($id) {
            $id->delete();
        });
    }
}
