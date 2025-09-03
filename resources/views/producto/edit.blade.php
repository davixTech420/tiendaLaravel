@extends('adminlte::page')

@section('title', 'Modifica Producto')

@section('content_header')
    <h1>Modifica Producto</h1>
@stop

@section('content')
    <p>Contenido de las tablas</p>


@section('template_title')
    {{ __('Update') }} Producto
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('productos.update', $producto->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
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