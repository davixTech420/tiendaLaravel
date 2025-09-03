<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Cliente') }}
            {{ Form::text('cliente_id', $deselist->cliente_id, ['class' => 'form-control' . ($errors->has('cliente_id') ? ' is-invalid' : ''), 'placeholder' => 'Cliente Id']) }}
            {!! $errors->first('cliente_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">  
            {{ Form::label('Producto') }}
            {{ Form::select('producto_id', $productosActivos->pluck('Nombre','id'), $deselist->producto_id, ['class' => 'form-control' . ($errors->has('producto_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('producto_id', '<div class="invalid-feedback">:message</div>') !!}
    </div> 


       

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>