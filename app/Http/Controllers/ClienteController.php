<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Services\ClienteService;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function __construct(ClienteService $clienteService)
    {
        $this->clienteService = $clienteService;
    }

    public function index()
    {
        $clientes = Cliente::all();

        return view('admin.clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClienteRequest $request)
    {
        // $datos = $request->all();
        // return response()->json($datos);

        try {
            $cliente = $this->clienteService->CrearCliente($request->validated());
            return redirect()->route('admin.clientes.index')->with('success', 'Cliente creado exitosamente.');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al crear el cliente: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        $cliente = $this->clienteService->mostrarCliente($cliente);
        return view('admin.clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClienteRequest $request, Cliente $cliente)
    {
            // $datos = $request->all();
            // return response()->json($datos);
        try {
            $cliente = $this->clienteService->ActualizarCliente($cliente, $request->validated());
            return redirect()->route('admin.clientes.index')->with('success', 'Cliente actualizado exitosamente.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al actualizar el cliente: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $id)
    {
        try{
            $this->clienteService->eliminarCliente($id);
            return redirect()->route('admin.clientes.index')->with('success', 'Cliente eliminado exitosamente.');
        }catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al eliminar el cliente: ' . $e->getMessage()]);
        }
    }
}
