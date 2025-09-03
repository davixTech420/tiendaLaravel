@extends('adminlte::page')

@section('title', 'Datech || Los Mejores Precios')

@section('content_header')
    <h1>Nuevo Producto</h1>
@stop
@section('content')
    <p>Contenido de las tablas</p>
@section('template_title')
    {{ __('Create') }} Producto
@endsection
@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                @includeif('partials.errors')
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title"></span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('productos.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf
                            @include('producto.form')
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