@extends('adminlte::page')

@section('title','Datech || Los Mejores Precios')

@section('template_title')
    {{ __('Create') }} Calificacion
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Calificacion</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('calificacion.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('calificacion.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
