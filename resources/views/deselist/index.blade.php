@extends('adminlte::page')
@section('title', 'Datech || Los Mejores Precios')

@section('content_header')

    <center><h1>Lista De Deseos</h1></center>
    <p>Filtrar</p>
    <form action="{{ route('deselists.index') }}" method="GET">
    <div class="form-row">
        <div class="col-md-2 mb-1">
            <input type="number" name="codi" class="form-control" placeholder="Codigo" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
        </div>
        <div class="col-md-2 mb-1">
            <input type="number" name="cliente" class="form-control" placeholder="Codigo Del Cliente" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
        </div>
        <div class="col-md-2 mb-1">
            <select class="form-control" name="pro_id">              
                <option value="">Productos</option>
                @foreach ($productosActivos as $productos)
                <option value="{{ $productos->id }}">{{ $productos->Nombre }}</option>
                @endforeach
            </select>
        </div>
       
        <div class="col-md-1 mb-1">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </div>
</form>
@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                        
                                <a href="{{ route('pdfDESE') }}"><i class="fas fa-file-pdf"> </i></a>                            
                                <a href="#"><i class="fas fa-file-excel "></i></a>  
                            
                            </span>

                             <div class="float-right">
                                <a href="{{ route('deselists.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                            @if ($deselists->isEmpty())
                    <p>No Se Enuentran Resultados</p>
                    @else     
                                <thead class="thead">
                                    <tr>
                                        <th>Codigo</th>		
                                        <th>Producto</th>								
										<th>Codigo Cliente</th>										
                                        <th>Registro</th> 
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($deselists as $deselist)
                                        <tr>
                                            <td>{{ $deselist->id }}</td>
                                            <td><img src="{{  asset($deselist->producto->imagen)}}" alt="" width="120px"></td>
                                            <td>{{ $deselist->cliente_id }}</td>
                                            <td>{{ $deselist->updated_at }}</td>
                                            <td>
                                                <form action="{{ route('deselists.destroy',$deselist->id) }}" method="POST">
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
                {!! $deselists->links('pagination::bootstrap-4') !!}
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
@section('js')
    <script> console.log('Hi!'); </script>
@stop