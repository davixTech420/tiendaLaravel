@extends('adminlte::page')
@section('title','Datech || Los Mejores Precios')
@section('content_header')
<center><h1>Cupones</h1></center>
<p>Filtrar</p>
<form action="{{ route('cupone.index') }}" method="GET">
<div class="form-row">
    <div class="col-md-2 mb-1">
        <input type="number" name="id" class="form-control" placeholder="Codigo" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
    </div>
    <div class="col-md-2 mb-1">
        <input type="text" name="cupon" class="form-control" placeholder="Cupon">
    </div>
    <div class="col-md-2 mb-1">
        <input type="date" name="fec_ini" class="form-control">
    </div>
    <div class="col-md-2 mb-1">
        <input type="date" name="fec_fin" class="form-control">
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
@endsection
@section('template_title')
    Cupones
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                             
                             <a href="{{ route('pdfCUPO') }}"><i class="fas fa-file-pdf"> </i></a>                            
                             <a href="#"><i class="fas fa-file-excel "></i></a>  
                            </span>

                             <div class="float-right">
                                <a href="{{ route('cupones.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                             @if ($cupones->isEmpty())
<p>No Se Encuentran Resultados</p>
                             @else
                                 
                             
                             
                                <thead class="thead">
                                    <tr>
                                        <th>Codigo</th>
										<th>Cupon</th>
										<th>Descuento</th>
										<th>Fecha Inicio</th>
										<th>Fecha Fin</th>
										<th>Multiples Usos</th>
										<th>Cantidad</th>
										<th>Categorias</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cupones as $cupone)
                                        <tr>
                                            <td>{{ $cupone->id }}</td>
											<td>{{ $cupone->cupon }}</td>
											<td>{{ $cupone->descuento }}</td>
											<td>{{ $cupone->fec_ini }}</td>
											<td>{{ $cupone->fec_fin }}</td>
											<td>{{ $cupone->mul_usos }}</td>
											<td>{{ $cupone->cantidad }}</td>
											<td>{{ $cupone->categorias }}</td>
                                            <td style="color:{{ $cupone->estado == 'Activo' ? 'green' : 'red'   }};"  >{{ $cupone->estado }}</td>

                                            <td>
                                                <form action="{{ route('cupones.destroy',$cupone->id) }}" method="POST">
                                                    @if ($cupone->estado == 'Activo')
                                            <a class="btn btn-sm btn-primary inac" href="{{ route('inaCUPO',$cupone->id) }}" style="background:yellow; color:black;"><i class="fa fa-ban"></i> {{ __('Inactivar') }}</a>
                                            @else
                                            <a class="btn btn-sm btn-primary" href="{{ route('actiCUPO',$cupone->id) }}" style="background:yellow;color:black;" ><i class="fa fa-check"></i> {{ __('Activar') }}</a>
                                            @endif
                                                    <a class="btn btn-sm btn-success" href="{{ route('cupones.edit',$cupone->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm elim"><i class="fa fa-fw fa-trash"></i></button>
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
                {!! $cupones->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
@endsection
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
</style>
@stop