<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('Nombre') }}
            {{ Form::text('Nombre', $producto->Nombre, ['class' => 'form-control' . ($errors->has('Nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('Nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Marca') }}
            {{ Form::text('Marca', $producto->Marca, ['class' => 'form-control' . ($errors->has('Marca') ? ' is-invalid' : ''), 'placeholder' => 'Marca']) }}
            {!! $errors->first('Marca', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('descripcion') }}
            {{ Form::text('descripcion', $producto->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
            {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Precio') }}
            {{ Form::number('Precio', $producto->Precio, ['class' => 'form-control' . ($errors->has('Precio') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}
            {!! $errors->first('Precio', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('stock') }}
            {{ Form::number('stock', $producto->stock, ['class' => 'form-control' . ($errors->has('stock') ? ' is-invalid' : ''), 'placeholder' => 'stock' ,
                'oninput' =>  "this.value = this.value.replace(/[^0-9]/g,'');"]) }}
            {!! $errors->first('stock', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">  
            {{ Form::label('Categoria') }}
            {{ Form::select('categoria_id',$categoriasActivas, $producto->categoria_id, ['class' => 'form-control' . ($errors->has('categoria_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('categoria_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group">
    @if (empty($producto->imagen))
{{ Form::file('imagen', ['class' => 'form-control' . ($errors->has('imagen') ? ' is-invalid' : ''),
'required']) }}
@else
<script type="text/javascript">
    let isTableVisible = false;
    function mostrarT() 
    {                   const tabReg = document.getElementById("actua");
const imagen = document.getElementById("img");
tabReg.style.display = isTableVisible ? "none" : "block";
imagen.style.display = isTableVisible ? "block" : "none";
isTableVisible = !isTableVisible;

}
    </script>
      <div class="container">
        <img src="{{ asset($producto->imagen) }}" width="150px" id="img">
        <button id="cam" onclick="mostrarT(); event.preventDefault();">Cambiar</button>
      </div>
      <div class="form-group">
     {{ Form::file('imagNew', ['class' => 'form-control ' . ($errors->has('imagNew') ? ' is-invalid' : ''),
    'style' => 'display:none;',
    'id' => 'actua']) }} 
    </div>
@endif
    </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>