<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'email',
        'cuit',
        'empresa_id',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
