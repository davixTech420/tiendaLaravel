@extends('adminlte::page')

@section('title', 'Datech || Los Mejores Precios')

@section('content_header')
    <center><h1>Categorias</h1></center>
    <p>Filtrar</p>
    <form action="{{ route('categoria.index') }}" method="GET">
    <div class="form-row">
        <div class="col-md-2 mb-1">
            <input type="number" name="id" class="form-control" placeholder="Codigo" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
        </div>
        <div class="col-md-2 mb-1">
            <input type="text" name="Nombre" class="form-control" placeholder="Nombre" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '');">
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
    <p>Contenido de las tablas</p>
@section('template_title')
    Categoria
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                <a href="{{ route('pdfCA',request()->all())}}" style="font-size: 40px;color:red; padding-right:15px;"> <i class="fas fa-file-pdf"></i></a>
                                <a href="#" style="font-size: 40px;color:green; "> <i class="fas fa-file-excel"></i></a>
                            </span>


                             <div class="float-right">
                                <a href="{{ route('categorias.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @elseif ($message=Session::get('error'))
                        <div class="alert alert-fail" style="background:red; color:white;">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                          
                            <table class="table table-striped table-hover">
                                @if ($categorias->isEmpty())
                                <p>No Se Encuentran Resultados</p>
                                @else
                                <thead class="thead">
                                    <tr>
                                        <th>Codigo</th>                                        
										<th>Nombre</th>
										<th>Descripcion</th>
                                        <th>Registro</th>
                                        <th>Estado</th>                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categorias as $categoria)
                                        <tr>
                                            <td>{{ $categoria->id }}</td>
                                            
											<td>{{ $categoria->Nombre }}</td>
											<td>{{ $categoria->Descripcion }}</td>
										    <td>{{  $categoria->updated_at }}</td>
                                            <td style="color: {{ $categoria->Estado == 'Inactivo' ? 'red' : 'green' }}" >{{ $categoria->Estado }}</td>

                                            <td>
                                                <form action="{{ route('categorias.destroy',$categoria->id) }}" method="POST">
                                                 @if ($categoria->Estado == 'Activo')
                                                    <a class="btn btn-sm btn-primary inac" href="{{ route('inacCA',$categoria->id) }}" style="color:black;  background:yellow;"><i class="fa fa-ban"></i> {{ __('Inactivar') }}</a>
                                                @else
                                                <a class="btn btn-sm btn-primary " href="{{ route('actiCA',$categoria->id) }}" style="color:black; background:yellow;" ><i class="fa fa-check"></i>     {{ __('Activar') }}</a>
                                                @endif
                                                    <a class="btn btn-sm btn-success" href="{{ route('categorias.edit',$categoria->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="elim btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> </button>
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
                {!! $categorias->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
@endsection
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop