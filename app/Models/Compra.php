<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $fillable = [
        'numero_compra',
        'fecha_compra',
        'total_compra',
        'proveedor_id',
        'sucursal_id',
        'empresa_id',
        'estado',
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function detalles()
    {
        return $this->hasMany(DetalleCompra::class);
    }
}
