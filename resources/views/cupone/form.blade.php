<div class="box box-info padding-1">
    <div class="box-body">        
        <div class="form-group">
            {{ Form::label('Cupon') }}
            {{ Form::text('cupon', $cupone->cupon, ['class' => 'form-control' . ($errors->has('cupon') ? ' is-invalid' : ''), 'placeholder' => 'Cupon']) }}
            {!! $errors->first('cupon', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Descuento') }}
            {{ Form::number('descuento', $cupone->descuento, ['class' => 'form-control' . ($errors->has('descuento') ? ' is-invalid' : ''), 'placeholder' => 'Descuento']) }}
            {!! $errors->first('descuento', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Fecha Inicio') }}
            {{ Form::date('fec_ini', $cupone->fec_ini, ['class' => 'form-control' . ($errors->has('fec_ini') ? ' is-invalid' : ''), 'placeholder' => 'Fec Ini']) }}
            {!! $errors->first('fec_ini', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Fecha Fin') }}
            {{ Form::date('fec_fin', $cupone->fec_fin, ['class' => 'form-control' . ($errors->has('fec_fin') ? ' is-invalid' : ''), 'placeholder' => 'Fec Fin']) }}
            {!! $errors->first('fec_fin', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Multiples Usos') }}
            {{ Form::text('mul_usos', $cupone->mul_usos, ['class' => 'form-control' . ($errors->has('mul_usos') ? ' is-invalid' : ''), 'placeholder' => 'Mul Usos']) }}
            {!! $errors->first('mul_usos', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Cantidad') }}
            {{ Form::text('cantidad', $cupone->cantidad, ['class' => 'form-control' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad']) }}
            {!! $errors->first('cantidad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Categorias') }}
            @foreach($categorias as $categoria)
                <div class="form-check">
                    {{ Form::checkbox('categorias[]', $categoria->id, (is_array($cupone->categorias) && in_array($categoria->id, $cupone->categorias)), ['class' => 'form-check-input' . ($errors->has('categorias') ? ' is-invalid' : '')]) }}
                    {{ Form::label($categoria->Nombre, $categoria->Nombre, ['class' => 'form-check-label']) }}
                </div>
            @endforeach
            {!! $errors->first('categorias', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        

        

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>