<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('estrellas') }}
            {{ Form::text('estrellas', $calificacion->estrellas, ['class' => 'form-control' . ($errors->has('estrellas') ? ' is-invalid' : ''), 'placeholder' => 'Estrellas']) }}
            {!! $errors->first('estrellas', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cliente_id') }}
            {{ Form::text('cliente_id', $calificacion->cliente_id, ['class' => 'form-control' . ($errors->has('cliente_id') ? ' is-invalid' : ''), 'placeholder' => 'Cliente Id']) }}
            {!! $errors->first('cliente_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('producto_id') }}
            {{ Form::select('producto_id', $productosActivos->pluck('Nombre','id'), $calificacion->id ,['class' => 'form-control' . ($errors->has('producto_id') ? ' is-invalid' : ''), ]) }}
            {!! $errors->first('producto_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>