

@extends('adminlte::page')
  
@section('title', 'Datech || Los Mejores Precios')

@section('content_header')
    <center><h1>Productos</h1></center>
    <p>Filtrar</p>
    <form action="{{ route('productos.index') }}" method="GET">
    <div class="form-row">
        <div class="col-md-2 mb-1">
            <input type="number" name="id" class="form-control" placeholder="Codigo" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
        </div>
        <div class="col-md-2 mb-1">
            <input type="text" name="Nombre" class="form-control" placeholder="Nombre" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '');">
        </div>
        <div class="col-md-2 mb-1">
            <input type="text" name="Marca" class="form-control" placeholder="Marca" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '');">
        </div>
        <div class="col-md-2 mb-1">
            <input type="number" name="stock" class="form-control" placeholder="Stock" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
        </div>
        <div class="col-md-2 mb-1"> 
            <select class="form-control" name="categoria_id">              
                <option value="">Categorias</option>
                @foreach ($categoriasActivas as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->Nombre }}</option>
                @endforeach
            </select>
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
    Producto
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                <a href="{{ route('pdfPRO',request()->all() )}}" style="color: red;font-size:35px;"> <i class="fas fa-file-pdf pdf" ></i> </a>
                                <a href="#">   <i class="fas fa-file-excel" style="color: green;font-size:35px; padding-left:10px;"></i> </a>
                            </span>
                             <div class="float-right">
                              
                                <a href="{{ route('productos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                            @if ($producto->isEmpty())
                            <p>No Se Encuentran Resultados</p>
                            @else
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Imagen</th>
										<th>Nombre</th>
                                        <th>Marca</th>
                                        <th>Descripcion</th>
										<th>Precio</th>
										<th>Stock</th>
										<th>Categoria</th>
                                        <th>Registro</th>
                                        <th>Estado</th>                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($producto as $productos)
                                        <tr>
                                            <td>{{ $productos->id }}</td>
											<td> <img src="{{  asset($productos->imagen)   }}" alt="" width="120px">  </td>
                                            <td>{{ $productos->Nombre }}</td>
                                            <td>{{ $productos->Marca }}</td>
                                            <td>{{ $productos->descripcion }}</td>
											<td>{{ $productos->Precio }}</td>
											<td>{{ $productos->stock }}</td>
											<td>{{ $productos->categoria()->pluck('Nombre')->implode(',')}}</td>
                                            <td>{{ $productos->updated_at }}</td>
                                            <td  style="color: {{ $productos->Estado == 'Inactivo' ? 'red' : 'green' }}"   >{{ $productos->Estado }}</td>
                                            <td>
                                                <form action="{{ route('productos.destroy',$productos->id) }}" method="POST">
                                                    @if ( $productos->Estado == 'Activo')
                                                    <a class="btn btn-sm btn-primary inac" href="{{ route('inac',$productos->id) }}" style="color:black;  background:yellow;"> <i class="fa fa-ban"></i>     {{ __('Inactivar') }}</a>
                                                    @else
                                                    <a class="btn btn-sm btn-primary " href="{{ route('acti',$productos->id) }}" style="color:black;  background:yellow;" ><i class="fa fa-check"></i> {{ __('Activar') }}</a>
                                                    @endif                                                                                 
                                                    <a class="btn btn-sm btn-success" href="{{ route('productos.edit',$productos->id) }}"><i class="fa fa-fw fa-edit"></i> </a>
                    
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="elim btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                    </div>
                </div>
       {!! $producto->links('pagination::bootstrap-4') !!}   
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