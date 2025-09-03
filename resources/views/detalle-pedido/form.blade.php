<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('Codigo Del Pedido') }}
            {{ Form::text('pedido_id', $detallePedido->pedido_id, ['class' => 'form-control' . ($errors->has('pedido_id') ? ' is-invalid' : ''), 'placeholder' => 'Pedido Id']) }}
            {!! $errors->first('pedido_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">  
            {{ Form::label('Producto') }}
            {{ Form::select('producto_id', $productosActivos->pluck('Nombre','id'), $detallePedido->producto_id, ['class' => 'form-control' . ($errors->has('producto_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('producto_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>        
        <div class="form-group">
            {{ Form::label('Cantidad') }}
            {{ Form::text('Cantidad', $detallePedido->Cantidad, ['class' => 'form-control' . ($errors->has('Cantidad') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad']) }}
            {!! $errors->first('Cantidad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
      
      

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>