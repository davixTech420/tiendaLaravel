@extends('adminlte::page')
@section('title', 'Datech || Los Mejores Precios')


@section('template_title')
    {{ __('Update') }} Deselist
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Deselist</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('deselists.update', $deselist->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('deselist.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
