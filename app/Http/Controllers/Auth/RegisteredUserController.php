<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }
   

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        if (User::firstWhere('email', $request->email) || Cliente::firstWhere('email', $request->email)) {
            return redirect(route('register'))->with('error', 'Email ya registrado');
        }
        elseif (User::firstWhere('documento', $request->documento) || Cliente::firstWhere('documento', $request->documento)) {
            return redirect(route('register'))->with('error', 'Documento ya registrado');
        }
        elseif (User::firstWhere('telefono', $request->telefono) || Cliente::firstWhere('Telefono', $request->telefono)) {
            return redirect(route('register'))->with('error', 'Telefono ya registrado');
        }
        else {
        $request->validate([
            'documento' => ['required','unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'apellido' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'telefono' => ['required'],
            'direccion' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            
        ]);

        $user = User::create([
            'documento' => $request->documento,
            'name' => $request->name,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'password' => Hash::make($request->password),
            'Estado' => "Activo",
        ]);
        event(new Registered($user));
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }
}
}
