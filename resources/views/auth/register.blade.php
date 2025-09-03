

@include('partials.nav')
<x-guest-layout> 
   
    @if ($message = Session::get('error') )
    <div class="alert alert-fail" style="background: red;color:white;">
        <p>{{ $message }}</p>
    </div><br>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <!-- Documento -->
        <div>
            <x-input-label for="documento" :value="__('documento')" />
            <x-text-input id="documento" class="block mt-1 w-full" type="number" name="documento" :value="old('documento')" required autofocus autocomplete="documento"  oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, this.maxLength);"  maxlength="15"   />
            <x-input-error :messages="$errors->get('documento')" class="mt-2" />
        </div> 

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"  oninput="this.value = this.value.replace(/[^a-zA-Z]/g, '').slice(0, this.maxLength);"  maxlength="15"   />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
      <!-- apellido -->
        <div>
            <x-input-label for="apellido" :value="__('apellido')" />
            <x-text-input id="apellido" class="block mt-1 w-full" type="text" name="apellido" :value="old('apellido')" required autofocus autocomplete="apellido" oninput="this.value = this.value.replace(/[^a-zA-Z]/g, '').slice(0, this.maxLength);"  maxlength="15"  />
            <x-input-error :messages="$errors->get('apellido')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
       <!-- telefono -->
        <div>
            <x-input-label for="telefono" :value="__('telefono')" />
            <x-text-input id="telefono" class="block mt-1 w-full" type="text" name="telefono" :value="old('telefono')" required autofocus autocomplete="telefono" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, this.maxLength);"  maxlength="10"/>
            <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
        </div>
         <!-- Direccion -->
         <div>
            <x-input-label for="direccion" :value="__('direccion')" />
            <x-text-input id="direccion" class="block mt-1 w-full" type="text" name="direccion" :value="old('direccion')" required autofocus autocomplete="direccion" /> 
            <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
@include('partials.footer')



