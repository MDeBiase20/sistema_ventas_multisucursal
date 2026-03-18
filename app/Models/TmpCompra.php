<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmpCompra extends Model
{
    protected $table = 'tmp_compras';

    protected $fillable = [
        'session_id',
        'producto_id',
        'cantidad',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
