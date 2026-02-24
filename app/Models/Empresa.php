<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Nnjeim\World\Models\Country;
use Nnjeim\World\Models\State;
use Nnjeim\World\Models\City;
use Nnjeim\World\Models\Currency;

class Empresa extends Model
{
    protected $fillable = [
        'nombre',
        'cuit',
        'pais_id',
        'ciudad_id',
        'departamento_id',
        'tipo_empresa',
        'direccion',
        'telefono',
        'email',
        'impuesto',
        'nombre_impuesto',
        'moneda_id',
        'codigo_postal',
        'logo',
    ];

    // Relación con usuarios
    public function usuarios()
    {
        return $this->hasMany(User::class);
    }

    public function pais()
    {
        return $this->belongsTo(Country::class, 'pais_id');
    }

    public function departamento()
    {
        return $this->belongsTo(State::class, 'departamento_id');
    }

    public function ciudad()
    {
        return $this->belongsTo(City::class, 'ciudad_id');

    }

    public function moneda()
    {
        return $this->belongsTo(Currency::class, 'moneda_id');
    }

    public function sucursales()
    {
        return $this->hasMany(Sucursal::class);
    }

    public function proveedores()
    {
        return $this->hasMany(Proveedor::class);
    }
}
