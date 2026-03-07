@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Registro de Productos</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.productos.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-10">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="">Nombre del producto</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control"
                                                        value="{{ old('nombre', $producto->nombre ?? '') }}" name="nombre"
                                                        required>
                                                    @error('nombre')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-box"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="">Precio</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control"
                                                        value="{{ old('precio', $producto->precio ?? '') }}" name="precio"
                                                        required>
                                                    @error('precio')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-currency-dollar"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="">Código</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control"
                                                        value="{{ old('codigo', $producto->codigo ?? '') }}" name="codigo"
                                                        required>
                                                    @error('codigo')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-upc-scan"></i>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <br>

                                        <div class="row">

                                            <div class="col-md-4">
                                                <label for="">Sucursal</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <select class="form-control select2" name="sucursal_id">
                                                        <option value="" enabled>Seleccionar Sucursal</option>
                                                        @foreach ($sucursales as $sucursal)
                                                            <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('sucursal_id')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-list"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="">Proveedor</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <select class="form-control select2" name="proveedor_id">
                                                        <option value="" enabled>Seleccionar Proveedor</option>
                                                        @foreach ($proveedores as $proveedor)
                                                            <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('proveedor_id')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-list"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="">Stock</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="number" class="form-control"
                                                        value="{{ old('stock', $producto->stock ?? '') }}" name="stock"
                                                        required>
                                                    @error('stock')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-archive"></i>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-8">
                                                    <label for="">Descripción</label>
                                                    <textarea class="form-control" name="descripcion" rows="6" required>{{ old('descripcion', $producto->descripcion ?? '') }}</textarea>
                                                    @error('descripcion')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <br>

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary">Guardar Producto</button>
                                                <a href="{{ route('admin.productos.index') }}"
                                                    class="btn btn-secondary">Cancelar</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
