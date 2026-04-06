<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'email',
        'empresa_id',
    ];

    public function usuarios()
    {
        return $this->belongsToMany(
            User::class,
            'sucursal_usuario',
            'sucursal_id',
            'usuario_id'
        );
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

    public function cajas()
    {
        return $this->hasMany(Caja::class);
    }

    public function movimientoCajas()
    {
        return $this->hasMany(movimiento_caja::class);
    }

    public function productossucursal()
    {
        return $this->hasMany(ProductoSucursal::class);
    }

    public function ventas()
    {
        return $this->hasMany(Ventas::class);
    }

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }
}
