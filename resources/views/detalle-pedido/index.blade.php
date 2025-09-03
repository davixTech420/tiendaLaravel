@extends('adminlte::page')

@section('title', 'Datech || Los Mejores Precios')

@section('content_header')

    <center><h1>Productos De Los Pedidos</h1></center>
    <p>Filtrar</p>
    <form action="{{ route('detalle_pedido.index') }}" method="GET">
    <div class="form-row">
        <div class="col-md-2 mb-1">
            <input type="number" name="pedi_id" class="form-control" placeholder="Codigo Pedido" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
        </div>
        <div class="col-md-2 mb-1">
            <input type="number" name="id" class="form-control" placeholder="Codigo" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
        </div>
        <div class="col-md-2 mb-1">
            <select class="form-control" name="pro_id">              
                <option value="">Productos</option>
                @foreach ($productosActivos as $productos)
                <option value="{{ $productos->id }}">{{ $productos->Nombre }}</option>
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
    Detalle Pedido
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                <a href="{{ route('pdfDETPE',request()->all()) }}"> <i class="fas fa-file-pdf"></i> </a>
                                <a href="#"> <i class="fas fa-file-excel"></i> </a>
                            </span>

                             <div class="float-right">
                                <a href="{{ route('detalle_pedidos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                @if ($detallePedidos->isEmpty())
                                <p>No Se Encuentran Resultados</p>
                                @else
                                <thead class="thead">
                                    <tr>
                                        <th>Codigo Pedido</th>
                                        
                                        <th>Producto</th>                                      
										<th>Cantidad</th>																				
                                        <th>Registro</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallePedidos as $detallePedido)
                                        <tr>
                                            <td>{{ $detallePedido->pedido_id }}</td>
                                            
                                            <td><img src="{{  asset($detallePedido->producto->imagen)}}" alt="" width="120px"></td>                                            
											<td>{{ $detallePedido->Cantidad }}</td>
                                            <td>{{ $detallePedido->updated_at  }}</td>
                                            <td  style="color: {{ $detallePedido->Estado == 'Activo' ? 'green' : 'red'  }};"  >{{ $detallePedido->Estado }}</td>
                                            <td>
                                                <form class="funci" action="{{ route('detalle_pedidos.destroy',$detallePedido->id) }}" method="POST">
                                                    @if ($detallePedido->Estado == 'Activo')
                                                    <a class="btn btn-sm btn-primary inac" style="background: yellow;color:black;" href="{{ route('inacDP',$detallePedido->id) }}"><i class="fa fa-ban"></i> {{ __('Inactivar') }}</a>
                                                    @else
                                                    <a class="btn btn-sm btn-primary" style="background: yellow;color:black;"  href="{{ route('actiDP',$detallePedido->id) }}"><i class="fa fa-check"></i> {{ __('Activar') }}</a>
                                                    @endif
                                                    <a class="btn btn-sm btn-success" href="{{ route('detalle_pedidos.edit',$detallePedido->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="elim btn btn-danger btn-sm" ><i class="fa fa-fw fa-trash"></i></button>
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
                {!! $detallePedidos->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
@endsection
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
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
        
        .alert-fail{
            background: red;
            color: white; 
        }

   </style>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@stop