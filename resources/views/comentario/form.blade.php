<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('comentario') }}
            {{ Form::text('comentario', $comentario->comentario, ['class' => 'form-control' . ($errors->has('comentario') ? ' is-invalid' : ''), 'placeholder' => 'Comentario']) }}
            {!! $errors->first('comentario', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Codigo Cliente') }}
            {{ Form::text('cliente_id', $comentario->cliente_id, ['class' => 'form-control' . ($errors->has('cliente_id') ? ' is-invalid' : ''), 'placeholder' => 'Codigo Cliente']) }}
            {!! $errors->first('cliente_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Producto') }}
            {{ Form::select('producto_id',$productosActivos->pluck('Nombre','id'), $comentario->producto_id, ['class' => 'form-control' . ($errors->has('producto_id') ? ' is-invalid' : ''),]) }}
            {!! $errors->first('producto_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>