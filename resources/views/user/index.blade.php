@extends('adminlte::page')
@section('title', 'Datech || Los Mejores Precios')
@section('content_header')
    <center><h1>Admins</h1></center>
    <p>Filtrar</p>
    <form action="{{ route('users.index') }}" method="GET">
    <div class="form-row">
        <div class="col-md-2 mb-1">
            <input type="number" name="id" class="form-control" placeholder="Codigo" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
        </div>
        <div class="col-md-2 mb-1">
            <input type="number" name="documento" class="form-control" placeholder="Documento" oninput="this.value = this.value.replace(/[^0-9]/g,'');">
        </div>
        <div class="col-md-2 mb-1">
            <input type="text" name="nombre" class="form-control" placeholder="Nombre" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '');">
        </div>
        <div class="col-md-2 mb-1">
            <input type="text" name="apellido" class="form-control" placeholder="Apellido" oninput="this.value = this.value.replace(/[^A-Za-z]/g,'');">
        </div>
        <div class="col-md-2 mb-1">
            <input type="text" name="email" class="form-control" placeholder="Email">
        </div>
        <div class="col-md-2 mb-1">
            <input type="number" name="telefono" class="form-control" placeholder="Telefono" oninput="this.value = this.value.replace(/[^0-9]/g,'');">
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
    User
@endsection
@section('content')
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                               <a href="{{ route('pdfAD',request()->all())  }}" style="font-size: 40px;color:red; padding-right:15px;"> <i class="fas fa-file-pdf"></i>  </a>
                               <a href="{{ route('ExcAdm', request()->all()) }}"> <i class="fas fa-file-excel" style="font-size: 40px;color:green;"></i></a>
                            </span>
                             <div class="float-right">
                                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                        @if ($users->isEmpty())
                        <p>No Se Encontraron Resultados</p>
                        @else
                        <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Documento</th>
										<th>Nombre</th>
                                        <th>Apellido</th>
										<th>Email</th>
                                        <th>Telefono</th>
                                        <th>Direccion</th>
                                        <th>Registro</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr> 
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->documento }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->apellido}}</td>
											<td>{{ $user->email }}</td> 
                                            <td>{{  $user->telefono}}</td>
                                            <td>{{ $user->direccion  }}</td>
                                            <td>{{ $user->updated_at }}</td>
                                            <td style="color: {{ $user->Estado == 'Activo' ? 'green' : 'red' }}" > {{ $user->Estado }}</td> 
                                            <td>
                                                <form  action="{{ route('users.destroy',$user->id) }}" method="POST">
                                                @if ($user->Estado == 'Activo')    
                                                <a class="btn btn-sm btn-primary inac" href="{{ route('inacA',$user->id) }}" style="color:black;  background:yellow;"><i class="fa fa-ban"></i> {{ __('Inactivar') }}</a>
                                                @else
                                                <a class="btn btn-sm btn-primary " href="{{ route('actiA',$user->id) }}" style="color:black; background:yellow;" ><i class="fa fa-check"></i> {{ __('Activar') }}</a>
                                                @endif
                                                <a class="btn btn-sm btn-success" href="{{ route('users.edit',$user->id) }}"><i class="fa fa-fw fa-edit"></i> </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" id="elim" class="elim btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> </button>
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
                {!! $users->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
@endsection
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
 

</script>

@stop 