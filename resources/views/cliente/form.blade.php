<div class="box box-info padding-1">
    <div class="box-body">
    <div class="form-group">
            {{ Form::label('Documento') }}
            {{ Form::text('documento', $cliente->documento, ['class' => 'form-control' . ($errors->has('documento') ? ' is-invalid' : ''), 'placeholder' => 'Documento',
                'maxlength'=> '12',
                'oninput' => "this.value = this.value.replace(/[^0-9]/g, '').slice(0, this.maxLength);"
                ]) }}
            {!! $errors->first('documento', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Nombre') }}
            {{ Form::text('Nombre', $cliente->Nombre, ['class' => 'form-control' . ($errors->has('Nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre',
                'maxlength' => '20',
                'oninput' => "this.value = this.value.replace(/[^a-zA-Z]/g, '').slice(0, this.maxLength);"
                ]) }}
            {!! $errors->first('Nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Apellido') }}
            {{ Form::text('Apellido', $cliente->Apellido, ['class' => 'form-control' . ($errors->has('Apellido') ? ' is-invalid' : ''), 'placeholder' => 'Apellido',
                'maxlength'=> '15',
                'oninput' => "this.value = this.value.replace(/[^a-zA-Z]/g, '').slice(0, this.maxLength);"
                ]) }}
            {!! $errors->first('Apellido', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Edad') }}
            {{ Form::text('Edad', $cliente->Edad, ['class' => 'form-control' . ($errors->has('Edad') ? ' is-invalid' : ''), 'placeholder' => 'Edad' ,
                'maxlength' => '3',
                'oninput' => "this.value = this.value.replace(/[^0-9]/g, '').slice(0, this.maxLength);"
                ]) }}
            {!! $errors->first('Edad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Direccion') }}
            {{ Form::text('Direccion', $cliente->Direccion, ['class' => 'form-control' . ($errors->has('Direccion') ? ' is-invalid' : ''), 'placeholder' => 'Direccion']) }}
            {!! $errors->first('Direccion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Telefono') }}
            {{ Form::text('Telefono', $cliente->Telefono, ['class' => 'form-control' . ($errors->has('Telefono') ? ' is-invalid' : ''), 'placeholder' => 'Telefono',
                'maxlength'=> '10',
                'oninput' => "this.value = this.value.replace(/[^0-9]/g, '').slice(0, this.maxLength);"
                ]) }}
            {!! $errors->first('Telefono', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Email') }}
            {{ Form::email('Email', $cliente->Email, ['class' => 'form-control' . ($errors->has('Email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
            {!! $errors->first('Email', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('contraseña') }}
            {{ Form::text('contraseña', $cliente->contraseña, ['class' => 'form-control' . ($errors->has('contraseña') ? ' is-invalid' : ''), 'placeholder' => 'Contraseña']) }}
            {!! $errors->first('contraseña', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>