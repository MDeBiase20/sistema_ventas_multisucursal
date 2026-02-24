<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmpresaRequest;
use App\Models\Empresa;
use App\Services\EmpresaService;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    protected $empresaService;

    public function __construct(EmpresaService $empresaService)
    {
        $this->empresaService = $empresaService;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        // Obtener lista de países para el select
        $paises = $this->empresaService->obtenerPaises();
        $monedas = $this->empresaService->obtenerMonedas();

        return view('admin.empresas.create', compact('paises', 'monedas'));
    }

    public function store(StoreEmpresaRequest $request)
    {
        // $datos = $request->all();
        // return response()->json($datos);
        try {
            // Creamos la empresa con el rol administrador
            $data = $request->validated();
            $data['logo'] = $request->file('logo');

            $resultado = $this->empresaService->crearEmpresaConAdministrador($data);

            return redirect()->route('login')
                ->with('success', 'Empresa creada exitosamente.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Error al crear la empresa: '.$e->getMessage()]);
        }
    }

    // Obtenemos estados por país (AJAX)
    public function obtenerEstados($paisId)
    {
        try {
            $estados = $this->empresaService->obtenerEstadoPorPais($paisId);

            return response()->json([
                'success' => true,
                'data' => $estados,
                'message' => 'Estados cargados correctamente',
            ]);

        } catch (\Exception $e) {
            \Log::error('Error al obtener estados: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'data' => [],
                'message' => 'Error al cargar los estados',
            ], 500);
        }
    }

    // Obtenemos ciudades por estado (AJAX)
    public function obtenerCiudades($estadoId)
    {
        try {
            $ciudades = $this->empresaService->obtenerCiudadesPorEstado($estadoId);

            return response()->json([
                'success' => true,
                'data' => $ciudades,
                'message' => 'Ciudades cargadas correctamente',
            ]);

        } catch (\Exception $e) {
            \Log::error('Error al obtener ciudades: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'data' => [],
                'message' => 'Error al cargar las ciudades',
            ], 500);
        }
    }

    public function show(Empresa $empresa)
    {
        //
    }

    public function edit($id)
    {
        $empresa = $this->empresaService->obtenerEmpresaPorId($id);

        // traemos los países, estados y ciudades que se encuentran en la tabla empresas para mostrar en el select
        $paises = $this->empresaService->obtenerPaises();
        $estados = $this->empresaService->obtenerEstadoPorPais($empresa->pais_id);
        $ciudades = $this->empresaService->obtenerCiudadesPorEstado($empresa->departamento_id);
        $monedas = $this->empresaService->obtenerMonedas();

        return view('admin.empresas.configuracion', compact('empresa', 'paises', 'estados', 'ciudades', 'monedas'));
    }

    public function update(Request $request, Empresa $empresa)
    {
        // $datos = $request->all();

        // return response()->json($datos);

        try {
            $resultado = $this->empresaService->actualizarEmpresa($empresa, $request->all());

            return redirect()->route('admin.empresas.configuracion', ['id' => $empresa->id])
                ->with('success', 'Empresa actualizada exitosamente.');
        } catch (\Throwable $th) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Error al actualizar la empresa: '.$th->getMessage()]);
        }

    }

    public function destroy(Empresa $empresa)
    {
        //
    }
}
