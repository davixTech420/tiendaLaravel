@extends('adminlte::page')
@section('title', 'Datech || Los Mejores Precios')

@section('template_title')
    {{ __('Create') }} Deselist
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Deselist</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('deselists.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('deselist.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
