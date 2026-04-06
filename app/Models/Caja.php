<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    protected $fillable = [
        'nombre',
        'monto_inicial',
        'monto_cierre_teorico',
        'monto_cierre_real',
        'diferencia',
        'monto_efectivo',
        'monto_transferencia',
        'monto_otros',
        'estado',
        'fecha_apertura',
        'fecha_cierre',
        'sucursal_id',
        'empresa_id',
        'usuario_id'
    ];

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function movimientos()
    {
        return $this->hasMany(movimiento_caja::class);
    }
}
