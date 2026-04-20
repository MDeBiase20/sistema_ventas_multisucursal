<?php

namespace App\Services;

use App\Models\Caja;
use App\Models\MovimientoCaja;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CajaService
{
    /**
     * Preparar datos para la caja
     */
    public function obtenerCajaAbierta(): Caja
    {
        $sucursal_id = session('sucursal_id');

        if (! $sucursal_id) {
            throw new \Exception('No hay sucursal activa');
        }

        $cantidad = Caja::where('sucursal_id', $sucursal_id)
            ->where('estado', 'abierta')
            ->count();

        if ($cantidad > 1) {
            throw new \Exception('Hay múltiples cajas abiertas. Inconsistencia crítica.');
        }

        return Caja::where('sucursal_id', $sucursal_id)
            ->where('empresa_id', Auth::user()->empresa_id)
            ->where('estado', 'abierta')
            ->lockForUpdate()
            ->firstOrFail();
    }

    private function getSucursalId()
    {
        $sucursal_id = session('sucursal_id');

        if (! $sucursal_id) {
            $sucursal = Sucursal::whereHas('usuarios', function ($q) {
                $q->where('usuario_id', Auth::id());
            })->first();

            if (! $sucursal) {
                throw new \Exception('El usuario no tiene sucursal asignada');
            }

            $sucursal_id = $sucursal->id;

            // IMPORTANTE: guardar en sesión
            session(['sucursal_id' => $sucursal_id]);
        }

        return $sucursal_id;
    }

    public function CrearCaja(array $data)
    {
        $sucursal_id = $this->getSucursalId();

        // Evitar múltiples cajas abiertas
        $existeCajaAbierta = Caja::where('usuario_id', Auth::id())
            ->where('estado', 'abierta')
            ->exists();

        if ($existeCajaAbierta) {
            throw new \Exception('Ya tienes una caja abierta');
        }

        $caja = Caja::create([
            'fecha_apertura' => $data['fecha_apertura'],
            'monto_inicial' => $data['monto_inicial'],
            'sucursal_id' => $sucursal_id,
            'empresa_id' => Auth::user()->empresa_id,
            'usuario_id' => Auth::id(),
            'estado' => 'abierta',
        ]);

        return $caja;
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
            'sucursal_id' => $sucursal_id,
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

            if ($caja->estado === 'cerrada') {
                throw new \Exception('La caja ya está cerrada');
            }

            $ingresos = MovimientoCaja::where('caja_id', $caja->id)
                ->where('tipo', 'ingreso')
                ->sum('monto');

            $egresos = MovimientoCaja::where('caja_id', $caja->id)
                ->where('tipo', 'egreso')
                ->sum('monto');

            $teorico = $caja->monto_inicial + $ingresos - $egresos;

            $real = ($data['monto_efectivo'] ?? 0)
            + ($data['monto_transferencia'] ?? 0)
            + ($data['monto_otros'] ?? 0);

            $diferencia = $real - $teorico;

            //             dd([
            //     'monto_inicial' => $caja->monto_inicial,
            //     'ingresos' => $ingresos,
            //     'egresos' => $egresos,
            //     'teorico' => $teorico,
            // ]);

            // 🔹 Actualizar caja
            $caja->update([
                'fecha_cierre' => now(),
                'monto_cierre_teorico' => $teorico,
                'monto_cierre_real' => $real,
                'diferencia' => $diferencia,
                'monto_efectivo' => $data['monto_efectivo'] ?? 0,
                'monto_transferencia' => $data['monto_transferencia'] ?? 0,
                'monto_otros' => $data['monto_otros'] ?? 0,
                'estado' => 'cerrada',
            ]);

            return $caja;
        });
    }

    public function obtenerIngresosPorCaja(Caja $caja)
    {

        return MovimientoCaja::where('caja_id', $caja->id)
            ->where('tipo', 'ingreso')
            ->where('tipo_operacion', 'venta') // 🔴 CLAVE
            ->get();
    }

    public function obtenerEgresosPorCaja(Caja $caja)
    {
        return MovimientoCaja::where('caja_id', $caja->id)
            ->where('tipo', 'egreso')
            ->where('tipo_operacion', 'compra') // 🔴 CLAVE
            ->get();
    }

    public function obtenerAnulaciones(Caja $caja)
    {
        return MovimientoCaja::where('caja_id', $caja->id)
            ->whereIn('tipo_operacion', ['anulación_venta', 'anulación_compra'])
            ->get();
    }

    // public function obtenerIngresosEgresos(Caja $caja)
    // {
    //     $ingresos = $caja->ingresos()->get();
    //     $egresos = $caja->egresos()->get();

    //     return [
    //         'ingresos' => $ingresos,
    //         'egresos' => $egresos,
    //     ];
    // }
}
