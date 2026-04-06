<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimientoCaja extends Model
{
    protected $fillable = [
        'tipo',
        'tipo_operacion',
        'monto',
        'descripcion',
        'sucursal_id',
        'empresa_id',
        'caja_id',
        'compra_id',
        'venta_id',
    ];

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function caja()
    {
        return $this->belongsTo(Caja::class);
    }
}
