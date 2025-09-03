@include('partials.nav')
<style>
  .form-control{
    padding-inline: 10px;
  }
</style>
@if ($message=Session::get('error'))
                        <div class="alert alert-fail" style="background:red; color:white;">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
<!-- Pills navs -->
<ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
    <li class="nav-item" role="presentation">
      <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="#pills-login" role="tab"
        aria-controls="pills-login" aria-selected="true">Login</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="#pills-register" role="tab"
        aria-controls="pills-register" aria-selected="false">Register</a>
    </li>
  </ul>
  <!-- Pills navs -->
  
  <!-- Pills content -->
  <div class="tab-content">
    <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
      <form method="post" action="{{ route('logCL') }}">
        @csrf
        <div class="text-center mb-3">
          <p>Sign in with:</p>
          <a href="{{ route('login-face') }}" type="button" class="btn btn-link btn-floating mx-1">
            <i class="bi bi-facebook"></i>
          </a>
  
          <a href="{{ route('login-google') }}" type="button" class="btn btn-link btn-floating mx-1">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="35" height="35" viewBox="0 0 48 48">
              <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path><path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path><path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path><path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path>
              </svg>
          </a>
        </div>
        <p class="text-center">or:</p>
        <!-- documento input -->
        <div class="form-outline mb-4 paddi">
          <input type="text" id="loginName" name="documento" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g,'');(this.value.length > 12);"  maxlength="12" required/>
          <label class="form-label" for="loginName">Documento</label>
        </div>

        <!--  email  input--> 
        <div class="form-outline mb-4 paddi">
          <input type="email" id="loginName" name="email" class="form-control" required/>
          <label class="form-label" for="loginName">Email</label>
        </div>      
  
        <!-- Password input -->   
        <div class="form-outline mb-4 paddi">
          <input type="password" id="password" name="password" class="form-control" required/>
          <label class="form-label" for="loginPassword">Password</label>
        </div>
  
        <!-- 2 column grid layout -->
        <div class="row mb-4">
          <div class="col-md-6 d-flex justify-content-center">
          
          <div class="form-check">
            <input class="form-check-input" type="checkbox" onclick="mostrarPassword()">
            <label class="form-check-label" for="mostrarContrasena">
                Mostrar contraseña
            </label>
        </div>
          <!-- Checkbox -->
            <div class="form-check mb-3 mb-md-0">
              <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked />
              <label class="form-check-label" for="loginCheck"> Remember me </label>
            </div>
          </div>
          <div class="col-md-6 d-flex justify-content-center">
            <!-- Simple link -->
            <a href="#!">Forgot password?</a>
          </div>
        </div>
  
        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>

        <!-- Register buttons -->
      </form>
    </div>
    <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
      <form action="{{ route('regis')}}" method="post">
         @csrf
        <div class="text-center mb-3">
          <p>Sign up with:</p>
          <a href="{{ route('login-face') }}" type="button" class="btn btn-link btn-floating mx-1">
            <i class="bi bi-facebook"></i>
          </a>
  
          <a  href="{{ route('login-google') }}" type="button" class="btn btn-link btn-floating mx-1">
            <svg id="goo" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="35" height="35" viewBox="0 0 48 48">
              <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path><path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path><path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path><path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path>
              </svg>
          </a>
        </div>
  
        <p class="text-center">Or :</p>
  
        <!-- Name input -->
        <div class="form-outline mb-4 paddi">
          <input type="number" id="registerName" class="form-control" name="documento" maxlength="12"  oninput="this.value = this.value.replace(/[^0-9]/g,'').slice(0, this.maxLength);"  required/>
          <label class="form-label" for="registerName">Documento</label>
        </div>
  
        <!-- Username input -->
        <div class="form-outline mb-4 paddi">
          <input type="text" id="registerUsername" class="form-control" name="nombre" oninput="this.value = this.value.replace(/[^A-Za-z]/g,'');" required/>
          <label class="form-label" for="registerUsername">Nombre</label>
        </div>
  
        <!-- Email input -->
        <div class="form-outline mb-4 paddi">
          <input type="text" id="registerEmail" class="form-control" name="apellido"  oninput="this.value = this.value.replace(/[^A-Za-z]/g,'');" required />
          <label class="form-label" for="registerEmail">Apellido</label>
        </div>
        <!-- Email input -->
        <div class="form-outline mb-4 paddi">
          <input type="number" id="registerEmail" class="form-control" maxlength="3" name="edad" oninput="this.value = this.value.replace(/[^0-9]/g,'').slice(0, this.maxLength);" required/>
          <label class="form-label" for="registerEmail">Edad</label>
        </div>
        <!-- Email input -->
        <div class="form-outline mb-4 paddi">
          <input type="texxt" id="registerEmail" class="form-control"  name="direccion" required/>
          <label class="form-label" for="registerEmail">Direccion</label>
        </div>
        <!-- Email input -->
        <div class="form-outline mb-4 paddi">
          <input type="number" id="registerEmail" class="form-control" maxlength="10" name="telefono" oninput="this.value = this.value.replace(/[^0-9]/g,'').slice(0, this.maxLength);" required/>
          <label class="form-label" for="registerEmail">Telefono</label>
        </div>
        <!-- Email input -->
        <div class="form-outline mb-4 paddi">
          <input type="email" id="registerEmail" class="form-control"  name="email" required/>
          <label class="form-label" for="registerEmail">Email</label>
        </div>
  
        <!-- Password input -->
        <div class="form-outline mb-4 paddi">
          <input type="password" id="registerPassword" class="form-control" name="contraseña" required/>
          <label class="form-label" for="registerPassword">Password</label>
        </div>
  
        <!-- Repeat Password input -->
        <div class="form-outline mb-4 paddi">
          <input type="password" id="registerRepeatPassword" class="form-control" />
          <label class="form-label" for="registerRepeatPassword">Repeat password</label>
        </div>
  
        <!-- Checkbox -->
        <div class="form-check d-flex justify-content-center mb-4">
          <input class="form-check-input me-2" type="checkbox" value="" id="registerCheck" checked
            aria-describedby="registerCheckHelpText" />
          <label class="form-check-label" for="registerCheck">
            I have read and agree to the terms
          </label>
        </div>  
        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block mb-3">Sign in</button>
      </form>
    </div>
  </div>
  <!-- Pills content -->
@include('partials.footer')