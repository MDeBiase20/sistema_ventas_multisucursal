<?php

namespace App\Services;

use App\Models\TmpCompra;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;

class TmpCompraService
{
    /**
     * Preparar datos para el cliente
     */
    public function CrearTmpCompra(array $data)
    {
        return DB::transaction(function () use ($data) {

            $producto = Producto::where('codigo', $data['codigo'])->first();

            if (! $producto) {
                throw new \Exception('Producto no encontrado');
            }

            return TmpCompra::create([
                'producto_id' => $producto->id,
                'cantidad' => $data['cantidad'],
                'session_id' => session()->getId(),
            ]);
        });
    }

    public function mostrarTmpCompra(TmpCompra $tmpCompra)
    {
        return $tmpCompra->load('empresa');

    }

    public function ActualizarTmpCompra(TmpCompra $tmpCompra, array $data): TmpCompra
    {
        $update = [
            'codigo' => $data['codigo'],
            'cantidad' => $data['cantidad'],
        ];

        $tmpCompra->update($update);

        return $tmpCompra;
    }

    public function eliminarTmpCompra(TmpCompra $id): void
    {
        DB::transaction(function () use ($id) {
            $id->delete();
        });
    }
}
