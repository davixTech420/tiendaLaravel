@extends('adminlte::page')

@section('title', 'Datech || Los Mejores Precios')

@section('content_header')
<center><h1>Clientes</h1></center>
<p>Filtrar</p>
<form action="{{ route('cliente.index') }}" method="GET">
    <div class="form-row">
        <div class="col-md-2 mb-1">
            <input type="number" name="id" class="form-control" placeholder="Codigo" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
        </div>
        <div class="col-md-2 mb-1">
            <input type="number" name="documento" class="form-control" placeholder="Documento" oninput="this.value = this.value.replace(/[^0-9]/g, '');" >
        </div>
        <div class="col-md-2 mb-1">
            <input type="text" name="Nombre" class="form-control" placeholder="Nombre"  oninput="this.value = this.value.replace(/[^a-zA-Z]/g, '');">
        </div>
        <div class="col-md-2 mb-1">
            <input type="text" name="Apellido" class="form-control" placeholder="Apellido" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '');" >
        </div>
        <div class="col-md-2 mb-1">
            <input type="text" name="Email" class="form-control" placeholder="Email">
        </div>
        <div class="col-md-2 mb-1">
            <input type="number" name="telefono" class="form-control" placeholder="Telefono" oninput="this.value = this.value.replace(/[^0-9]/g, '');" >
        </div>
        <div class="col-md-2 mb-1">
            <select class="form-control" name="Estado">
                <option value="">Estado</option>
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
            </select>
        </div>
        <div class="col-md-1 mb-1">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </div>
</form>
@stop
@section('content')
<p>Welcome to this beautiful admin panel.</p>
@section('template_title')
Cliente
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">
                            <a href="{{ route('pdfCL',request()->all()) }}" style="font-size: 35px; color:red; padding-right:15px;"> <i class="fas fa-file-pdf pdf"></i> </a>
                            <a href="#"> <i class="fas fa-file-excel" style="color: green;font-size:35px;"></i> </a>
                        </span>
                        <div class="float-right">
                            <a href="{{ route('clientes.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                {{ __('Create New') }}
                            </a>
                        </div>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
                @if ($message = Session::get('error'))
                <div class="alert alert-fail" style="background: red;color:white;">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <div class="card-body">
                    <div class="table-responsive">
                      
                    <table class="table table-striped table-hover">
                    @if ($clientes->isEmpty())
                    <p>No Se Enuentran Resultados</p>
                    @else         
                    <thead class="thead">
                                <tr>
                                    <th>Codigo</th>
                                    <th>Documento</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Edad</th>
                                    <th>Direccion</th>
                                    <th>Telefono</th>
                                    <th>Email</th>
                                    <th>Contraseña</th>
                                    <th>Registro</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientes as $cliente)
                                <tr>
                                    <td>{{ $cliente->id }}</td>
                                    <td>{{ $cliente->documento}}</td>
                                    <td>{{ $cliente->Nombre }}</td>
                                    <td>{{ $cliente->Apellido }}</td>
                                    <td>{{ $cliente->Edad }}</td>
                                    <td>{{ $cliente->Direccion }}</td>
                                    <td>{{ $cliente->Telefono }}</td>
                                    <td>{{ $cliente->Email }}</td>
                                    <td>{{ Str::limit($cliente->contraseña,5,'...')  }}</td>
                                    <td>{{ $cliente->updated_at }}</td>
                                    <td  style="color: {{ $cliente->Estado == 'Activo' ? 'green' : 'red' }}" >{{ $cliente->Estado }}</td>
                                    <td>
                                        <form action="{{ route('clientes.destroy',$cliente->id) }}" method="POST">
                                            @if ($cliente->Estado == 'Activo')
                                            <a class="btn btn-sm btn-primary inac" href="{{ route('inacCL',$cliente->id) }}" style="background:yellow; color:black;"><i class="fa fa-ban"></i> {{ __('Inactivar') }}</a>
                                            @else
                                            <a class="btn btn-sm btn-primary" href="{{ route('actiCL',$cliente->id) }}" style="background:yellow;color:black;" ><i class="fa fa-check"></i> {{ __('Activar') }}</a>
                                            @endif
                                            <a class="btn btn-sm btn-success" href="{{ route('clientes.edit',$cliente->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="elim btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        @endif
                        </table>
                    </div>
                </div>
            </div>
            {!! $clientes->links('pagination::bootstrap-4') !!}
        </div>
    </div>
</div>
@endsection
@stop

@section('css')

@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop