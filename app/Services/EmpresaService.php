<?php

namespace App\Services;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Nnjeim\World\Models\City;
use Nnjeim\World\Models\Country;
use Nnjeim\World\Models\Currency;
use Nnjeim\World\Models\State;

class EmpresaService
{
    /**
     * Crear una nueva empresa con usuario administrador
     */
    public function crearEmpresaConAdministrador(array $data): array
    {
        return DB::transaction(function () use ($data) {

            $empresa = Empresa::create($this->prepararDatosEmpresa($data));

            if (! empty($data['logo'])) {
                $this->guardarLogo($empresa, $data['logo']);
            }

            $usuario = $this->crearUsuario($empresa, $data);

            return [
                'empresa' => $empresa,
                'usuario' => $usuario,
            ];
        });
    }

    /**
     * Preparar datos para la empresa
     */
    private function prepararDatosEmpresa(array $data): array
    {
        $pais = Country::findOrFail($data['pais_id']);

        return [
            'nombre' => $data['nombre'],
            'pais_id' => $data['pais_id'],
            'departamento_id' => $data['departamento_id'],
            'ciudad_id' => $data['ciudad_id'],
            'moneda_id' => $data['moneda_id'],
            'tipo_empresa' => $data['tipo_empresa'],
            'direccion' => $data['direccion'],
            'telefono' => $data['telefono'],
            'email' => $data['email'],
            'cuit' => $data['cuit'],
            'impuesto' => $data['impuesto'],
            'nombre_impuesto' => $data['nombre_impuesto'],
            'codigo_postal' => $data['codigo_postal'],
        ];
    }

    /**
     * Guardar logo de la empresa
     */
    private function guardarLogo(Empresa $empresa, $logoFile): void
    {
        // Crear directorio si no existe
        $directory = "empresas/{$empresa->id}/logos";

        // Guardar archivo
        $path = $logoFile->store($directory, 'public');

        // Actualizar empresa con ruta del logo
        $empresa->update([
            'logo' => $path,
        ]);
    }

    /**
     * Crear usuario administrador para la empresa
     */
    private function crearUsuario(Empresa $empresa, array $data): User
    {
        $user = User::create([
            'name' => $data['nombre'] ?? $empresa->nombre,
            'email' => $data['email'] ?? $empresa->email,
            'password' => Hash::make((string) $data['cuit']),
            'empresa_id' => $empresa->id,
            'email_verified_at' => now(),
        ]);

        //     // Asignar rol de administrador
        //     $user->assignRole('admin_empresa');

        //     // Enviar email de bienvenida
        //     // dispatch(new SendWelcomeEmail($user, $empresa));

        return $user;
    }

    /**
     * Crear configuración inicial para la empresa
     */
    // private function crearConfiguracionInicial(Empresa $empresa): void
    // {
    //     // Crear sucursal principal
    //     $empresa->sucursales()->create([
    //         'nombre' => 'Sucursal Principal',
    //         'direccion' => $empresa->direccion,
    //         'telefono' => $empresa->telefono,
    //         'pais_id' => $empresa->pais_id,
    //         'estado_id' => $empresa->estado_id,
    //         'ciudad_id' => $empresa->ciudad_id,
    //         'es_principal' => true,
    //         'activa' => true,
    //     ]);

    // Crear configuración por defecto
    // $empresa->configuraciones()->create([
    //     'moneda' => 'PEN',
    //     'idioma' => 'es',
    //     'zona_horaria' => 'America/Lima',
    //     'formato_fecha' => 'd/m/Y',
    // ]);
    // }

    /**
     * Obtener lista de países
     */
    public function obtenerPaises()
    {
        return Country::orderBy('name')->get();
    }

    public function obtenerEstadoPorPais(int $paisId)
    {
        return State::where('country_id', $paisId)
            ->orderBy('name')
            ->get();
    }

    public function obtenerCiudadesPorEstado(int $estadoId)
    {
        return City::where('state_id', $estadoId)
            ->orderBy('name')
            ->get();
    }

    public function obtenerMonedas()
    {
        return Currency::orderBy('name')->get();
    }

    public function obtenerEmpresaPorId(int $id)
    {
        return Empresa::find($id);
    }

    // Función para actualizar empresa
    public function actualizarEmpresa(Empresa $empresa, array $data): Empresa
    {
        $logoAntiguo = $empresa->logo;

        DB::transaction(function () use ($empresa, $data, $logoAntiguo) {

            // actualizar datos generales
            $empresa->update($this->prepararDatosEmpresa($data));

            // SOLO si suben logo nuevo
            if (! empty($data['logo'])) {

                $this->guardarLogo($empresa, $data['logo']);

                // eliminar logo viejo SOLO después de guardar nuevo
                if ($logoAntiguo && Storage::disk('public')->exists($logoAntiguo)) {
                    Storage::disk('public')->delete($logoAntiguo);
                }
            }
        });

        return $empresa->fresh();
    }
}
