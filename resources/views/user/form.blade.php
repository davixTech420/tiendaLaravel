<div class="box box-info padding-1">
    <div class="box-body">
        
    <div class="form-group">
            {{ Form::label('documento') }}
            {{ Form::number('documento', $user->documento, ['class' => 'form-control' . ($errors->has('documento') ? ' is-invalid' : ''), 'placeholder' => 'Documento',
                'maxlength' => '12',
                'oninput' =>    "this.value = this.value.replace(/[^0-9]/g, '').slice(0, this.maxLength);"      ]) }}
            {!! $errors->first('documento', '<div class="invalid-feedback">:message</div>') !!}
        </div>      

          <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $user->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name',
                'maxlength' => '20',
                'oninput' =>    "this.value = this.value.replace(/[^a-zA-Z]/g, '').slice(0, this.maxLength);"      ]) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('apellido') }}
            {{ Form::text('apellido', $user->apellido, ['class' => 'form-control' . ($errors->has('apellido') ? ' is-invalid' : ''), 'placeholder' => 'Apellido',
                'maxlength' => '15',
                'oninput' => "this.value = this.value.replace(/[^a-zA-Z]/g, '').slice(0, this.maxLength);"
                ]) }}
            {!! $errors->first('apellido', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('email') }}
            {{ Form::email('email', $user->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('telefono') }}
            {{ Form::number('telefono', $user->telefono, ['class' => 'form-control' . ($errors->has('telefono') ? ' is-invalid' : ''), 'placeholder' => 'Telefono',
                'maxlength' => '10', 
                 'oninput' =>  "this.value = this.value.replace(/[^0-9]/g, '').slice(0, this.maxLength);"
                ]) }}
            {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('direccion') }}
            {{ Form::text('direccion', $user->direccion, ['class' => 'form-control' . ($errors->has('direccion') ? ' is-invalid' : ''), 'placeholder' => 'Direccion',
                'maxlength' => '35' 
                ]) }}
            {!! $errors->first('direccion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('password') }}
            {{ Form::text('password', $user->password, ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'placeholder' => 'password']) }}
            {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div> 
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>