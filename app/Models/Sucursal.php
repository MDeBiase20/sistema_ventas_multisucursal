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
}
