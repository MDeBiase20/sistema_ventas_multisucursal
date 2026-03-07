<?php

namespace App\Services;

use App\Models\Caja;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CajaService
{
    /**
     * Preparar datos para la caja
     */
    public function CrearCaja(array $data)
    {
        return DB::transaction(function () use ($data) {

            $caja = Caja::create([
                'fecha_apertura' => $data['fecha_apertura'],
                'monto_inicial' => $data['monto_inicial'],
                'sucursal_id' => $data['sucursal_id'],
                'empresa_id' => Auth::user()->empresa_id,
            ]);

            return $caja;
        });
    }

    public function mostrarCaja(Caja $caja)
    {
        return $caja->load('sucursal');
    }

    public function ActualizarCaja(Caja $caja, array $data): Caja
    {
        $update = [
            'fecha_apertura' => $data['fecha_apertura'],
            'monto_inicial' => $data['monto_inicial'],
            'sucursal_id' => $data['sucursal_id'],
        ];

        $caja->update($update);

        return $caja;
    }

    public function eliminarCaja(Caja $id): void
    {
        DB::transaction(function () use ($id) {
            $id->delete();
        });
    }

    public function cerrarCaja(Caja $caja, array $data): Caja
    {
        return DB::transaction(function () use ($caja, $data) {

            $caja->update([
                'fecha_cierre' => $data['fecha_cierre'],
                'monto_final' => $data['monto_final'],
            ]);

            return $caja;
        });
    }

    public function CrearIngresoEgreso(array $data)
    {
        return DB::transaction(function () use ($data) {

            $caja = Caja::create([
                'fecha_apertura' => $data['fecha_apertura'],
                'monto_inicial' => $data['monto_inicial'],
                'sucursal_id' => $data['sucursal_id'],
                'empresa_id' => Auth::user()->empresa_id,
            ]);

            return $caja;
        });
    }

    public function obtenerIngresosEgresos(Caja $caja)
    {
        $ingresos = $caja->ingresos()->get();
        $egresos = $caja->egresos()->get();

        return [
            'ingresos' => $ingresos,
            'egresos' => $egresos,
        ];
    }
}
