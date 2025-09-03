@extends('adminlte::page')

@section('title', 'Datech || Los Mejores Precios')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Contenido de las tablas</p>
    
<!--codigo para el grafico con chart.js -->

<!--aca termina el codigo para el grafico-->
    <div class="info-box bg-success">
  <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Likes</span>
    <span class="info-box-number"> @if($deseos == 0) No Hay Un Producto Favorito @else   {{$deseos}}   @endif   </span>
    <div class="progress">
      <div class="progress-bar" style="width: {{ $porcentaje_incremento }}%"></div>
    </div>
    <span class="progress-description">{{ $progress_description }}</span>
  </div>
</div>




    <div class="card">
  <div class="card-header">
    <h3 class="card-title">Datos Registrados</h3>
    <div class="card-tools">
      <!-- Collapse Button -->
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
    </div>
    <!-- /.card-tools -->
  </div>
  <!-- /.card-header -->
  <div class="card-body">



  <div class="container text-center">
  <div class="row align-items-center">
    
  
  <div class="col-md-3">
         <!--
        Este fragemnto mustra la cantidad de clientes que ahy  y un ink para e index de los clientes
     -->
     <div class="small-box bg-gradient-success">
      <div class="inner">
        <h3>{{ count($cliente) }}</h3>
        <p>Clientes Activos</p>
      </div>
      <div class="icon">
        <i class="fas fa-user-plus"></i>
      </div>
      <a href="{{ route('cliente.index') }}" class="small-box-footer">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
    <!-- ***
    }*-->
    </div>


    
    <div class="col-md-3">
          <!--
        Este fragemnto mustra la cantidad de productos que ahy  y un ink para e index de los clientes
     -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{ count($producto) }}</h3>
        <p>Productos</p>
      </div>
      <div class="icon">
        <i class="fas fa-shopping-cart"></i>
      </div>
      <a href="{{ route('productos.index') }}" class="small-box-footer">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
<!-- ***
    }*-->
    </div>





    <div class="col-md-3">
         <!--
        Este fragemnto mustra la cantidad de productos que ahy  y un ink para e index de los clientes
     -->
    <div class="small-box bg-info">
  <div class="inner">
    <h3>{{ count($pedido) }}</h3>
    <p>Pedidos</p>
  </div>
  <div class="icon">
    <i class="fas fa-envelope-open"></i>
  </div>
  <a href="{{ route('pedidos.index')  }}" class="small-box-footer">
    More info <i class="fas fa-arrow-circle-right"></i>
  </a>
</div>
<!-- ***
    }*-->
    </div>



<div class="col-md-3">
         <!--
        Este fragemnto mustra la cantidad de productos que ahy  y un ink para e index de los clientes
     -->
     <div class="small-box bg-info">
  <div class="inner">
    <h3>{{ count($categoria) }}</h3>
    <p>Categoria</p>
  </div>
  <div class="icon">
    <i class="fas fa-tag"></i>
  </div>
  <a href="{{ route('categoria.index') }}" class="small-box-footer">
    More info <i class="fas fa-arrow-circle-right"></i>
  </a>
</div>
<!-- ***
    }*-->
    
</div>
  </div>
</div>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->

 



      
    




    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Gráfico de área interactivo</h5>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
         
           
        </div>
    </div>
    

    



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop