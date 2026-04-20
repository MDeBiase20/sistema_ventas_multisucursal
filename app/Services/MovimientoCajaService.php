<?php

namespace App\Services;

use App\Models\Caja;
use App\Models\MovimientoCaja;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MovimientoCajaService
{
    /**
     * Preparar datos para la caja
     */
    public function CrearIngresoEgreso(array $data, Caja $caja)
    {
        return DB::transaction(function () use ($data, $caja) {

            if ($caja->empresa_id !== Auth::user()->empresa_id) {
                throw new \Exception('No tiene permiso para operar esta caja.');
            }

            if ($caja->estado === 'cerrada') {
                throw new \Exception('La caja ya está cerrada.');
            }

            return MovimientoCaja::create([
                'tipo' => $data['tipo_movimiento'],
                'tipo_operacion' => 'manual',
                'monto' => $data['monto'],
                'descripcion' => $data['descripcion'],
                'sucursal_id' => $caja->sucursal_id,
                'caja_id' => $caja->id,
                'empresa_id' => Auth::user()->empresa_id,
            ]);
        });
    }

    public function obtenerIngresosPorCaja(Caja $caja)
    {
        return MovimientoCaja::where('caja_id', $caja->id)
            ->where('tipo', 'ingreso')
            ->whereIn('tipo_operacion', ['venta', 'manual'])
            ->where(function ($query) {
                $query->whereNull('venta_id') // manual
                    ->orWhereHas('venta', function ($q) {
                        $q->where('estado', '!=', 'anulada');
                    });
            })
            ->get();
    }

    public function obtenerEgresosPorCaja(Caja $caja)
    {
        return MovimientoCaja::where('caja_id', $caja->id)
            ->where('tipo', 'egreso')
            ->whereIn('tipo_operacion', ['compra', 'manual'])
            ->where(function ($query) {
                $query->whereNull('compra_id') // manual
                    ->orWhereHas('compra', function ($q) {
                        $q->where('estado', '!=', 'anulada');
                    });
            })
            ->get();
    }
}
