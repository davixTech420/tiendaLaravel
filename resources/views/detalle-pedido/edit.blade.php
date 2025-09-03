@extends('adminlte::page')

@section('title', 'Datech || Los Mejores Precios')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Contenido de las tablas</p>


@section('template_title')
    {{ __('Update') }} Detalle Pedido
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Detalle Pedido</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('detalle_pedidos.update', $detallePedido->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('detalle-pedido.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop