@extends('adminlte::page')

@section('title', 'Datech || Los Mejores Precios')

@section('content_header')
    <center><h1>Pedidos</h1></center>
    <p>Filtrar</p>
    <form action="{{ route('pedidos.index') }}" method="GET">
    <div class="form-row">
        <div class="col-md-2 mb-1">
            <input type="number" name="id" class="form-control" placeholder="Codigo" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
        </div>
        <div class="col-md-2 mb-1">
            <input type="number" name="codi" class="form-control" placeholder="Codigo Cliente" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
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
    Pedido
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                <a href="{{ route('pdfPEDI',request()->all() )}}"><i class="fas fa-file-pdf"> </i></a>                            
                                <a href="#"><i class="fas fa-file-excel "> </i></a>  
                            </span> 
                             <div class="float-right">
                                <a href="{{ route('pedidos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                    <div class="alert alert-fail">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                @if ($pedidos->isEmpty())
                                <p>No Se Encuentran Resultados</p>
                                @else
                                <thead class="thead">
                                    <tr>                                        
                                        <th>Codigo</th>                                        
										<th>Codigo Cliente</th>
                                        <th>Cantidad De Productos</th>
                                        <th>Registro</th>
										<th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pedidos as $pedido)
                                        <tr>
                                            <td>{{ $pedido->id}}</td>                                            
											<td>{{ $pedido->cliente_id }}</td>
                                            <td>{{ $pedido->cantidad_productos }}</td>
                                            <td>{{ $pedido->updated_at }}</td>
                                            <td style="color: {{ $pedido->Estado == 'Activo' ? 'green' : 'red' }} " >{{ $pedido->Estado }}</td>											
                                            <td>
                                                <form action="{{ route('pedidos.destroy',$pedido->id) }}" method="POST">
                                                    @if ($pedido->Estado == 'Activo')
                                                    <a class="btn btn-sm btn-primary acin inac" href="{{ route('inacPE',$pedido->id) }}" style="color:black; background:yellow;"><i class="fa fa-ban"></i> {{ __('Inactivar') }}</a>
                                                    @else
                                                    <a class="btn btn-sm btn-primary acin" href="{{ route('actiPE',$pedido->id) }}" style="color:black; background:yellow;"><i class="fa fa-check"></i> {{ __('Activar') }}</a>
                                                    @endif
                                                    <a class="btn btn-sm btn-success" href="{{ route('pedidos.edit',$pedido->id) }}"><i class="fa fa-fw fa-edit"></i></a>
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
                {!! $pedidos->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
@endsection
@stop

@section('css')

<style>
.fa-file-pdf{
  font-size: 35px;
  padding-right: 15px;
  color: red;

}
.fa-file-excel{
  font-size: 35px;
  color:green;

}
</style>
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop