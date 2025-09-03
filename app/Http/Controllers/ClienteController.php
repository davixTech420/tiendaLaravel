<?php

namespace App\Http\Controllers;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\MustVerifyEmail;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\User; 
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use  App\Http\Middleware\IsBlocked;
use App\Models\Calificacion;
use App\Models\Comentario;
use App\Models\Deselist;
use App\Services\PasswordHash;
use Exception;

/**
 * Class ClienteController
 * @package App\Http\Controllers
 */
class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->input('id') || request()->input('documento') || request()->input('Nombre') || request()->input('Apellido') || request()->input('Email') || request()->input('telefono') || request()->input('Estado')) {
            $clientes = Cliente::query();
            if (request()->input('id')) {
                $clientes->where('id', 'LIKE', '%' . request()->input('id') . '%');
            }
            if (request()->input('documento')) {
                $clientes->where('documento', 'LIKE', '%' . request()->input('documento') . '%');
            }
            if (request()->input('Nombre')) {
                $clientes->where('Nombre', 'LIKE', '%' . request()->input('Nombre') . '%');
            }
            if (request()->input('Apellido')) {
                $clientes->where('Apellido', 'LIKE', '%' . request()->input('Apellido') . '%');
            }
            if (request()->input('telefono')) {
                $clientes->where('telefono', 'LIKE', '%' . request()->input('telefono') . '%');
            }
            if (request()->input('Email')) {
                $clientes->where('Email', 'LIKE', '%' . request()->input('Email') . '%');
            }
            if (request()->input('Estado')) {
                $clientes->where('Estado', 'LIKE', '%' . request()->input('Estado') . '%');
            }

            $clientes = $clientes->paginate();
            return view('cliente.index', compact('clientes'))
                ->with('i', (request()->input('page', 1) - 1) * $clientes->perPage());
        } else {
            $clientes = Cliente::paginate();
            return view('cliente.index', compact('clientes'))
                ->with('i', (request()->input('page', 1) - 1) * $clientes->perPage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cliente = new Cliente();
        return view('cliente.create', compact('cliente'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        if(User::firstWhere('documento',$request->input('documento'))){
            return redirect(route('cliente.index'))->with('error','Documento Registrado En El Sistema');
        }
        if(User::firstWhere('telefono',$request->input('Telefono'))){
            return redirect(route('cliente.index'))->with('error','Telefono Registrado En El Sistema');
        }
        if(User::firstWhere('email',$request->input('Email'))){
            return redirect(route('cliente.index'))->with('error','Email Registrado En El Sistema');
        }
        else{
        request()->validate(Cliente::$rules);
        $cliente = Cliente::create([
            "documento" => $request->input('documento'),
            "Nombre" => $request->input('Nombre'),
            "Apellido" => $request->input('Apellido'),
            "Edad" => $request->input('Edad'),
            "Direccion" => $request->input('Direccion'),
            "Telefono" => $request->input('Telefono'),
            "Email" => $request->input('Email'),
            "contraseña" => hash::make($request->input('contraseña')),
            "Estado" => "Activo",
        ]);
        $cliente->save();
        return redirect()->route('cliente.index')
            ->with('success', 'Cliente Creado Exitosamente.');
    }
    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function inactivar($id)
    {
          if (Pedido::firstWhere('cliente_id',$id)){
            return redirect(route('cliente.index'))->with('error','El Cliente Tiene Pedidos');
          }
        $cliente = Cliente::find($id);
        $cliente->Estado = 'Inactivo';
        $cliente->save();
        return redirect()->route('cliente.index')->with('success', 'Cliente Inactivado Exitosamente');
    }
    public function activar($id)
    {
        $cliente = Cliente::find($id);
        $cliente->Estado = 'Activo';
        $cliente->save();

        return redirect()->route('cliente.index')->with('success', 'Cliente Activado Exitosamente');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::find($id);
        return view('cliente.edit', compact('cliente'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $rules = Cliente::$rules;
        $rules['documento'] = ['required', Rule::unique('clientes', 'documento')->ignore($cliente->id)];
        $rules['Email'] = ['required', 'email', Rule::unique('clientes', 'Email')->ignore($cliente->id)];
        $rules['Telefono'] = ['required', 'max:10', 'min:10', Rule::unique('clientes', 'Telefono')->ignore($cliente->id)];
        // Valida la solicitud con las reglas modificadas
        $request->validate($rules);
        $cliente->update([
            "documento" => $request->input('documento'),
            "Nombre" => $request->input('Nombre'),
            "Apellido" => $request->input('Apellido'),
            "Edad" => $request->input('Edad'),
            "Direccion" => $request->input('Direccion'),
            "Telefono" => $request->input('Telefono'),
            "Email" => $request->input('Email'),
            "contraseña" => hash::make($request->input('contraseña')),
            "Estado" => "Activo",
        ]);
        $cliente->save();
        return redirect()->route('cliente.index')
            ->with('success', 'Cliente Modificado Exitosamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        if (Pedido::firstWhere('cliente_id',$id)){
            return redirect(route('cliente.index'))->with('error','El Cliente Tiene Pedidos');
          }
          elseif (Calificacion::firstWhere('cliente_id',$id)){
            return redirect(route('cliente.index'))->with('error','El Cliente Tiene Calificaciones');
          }
          elseif(Deselist::firstWhere('cliente_id',$id)){
            return redirect(route('cliente.index'))->with('error','El Cliente Tiene Lista De Deseos');
          }
          elseif(Comentario::firstWhere('cliente_id',$id)){
            return redirect(route('cliente.index'))->with('error','El Cliente Tiene Comentarios');
          }
        $cliente = Cliente::find($id);
        if ($cliente->Estado == 'Activo') {
            return redirect()->route('cliente.index')
                ->with('error', 'Cliente Activo No Se Puede Eliminar');
        } else {
            $cliente->delete();
            return redirect()->route('cliente.index')->with('success', 'Cliente Eliminado Exitosamente');
        }
    }

    

    public function register(request $request)
    {
        if(User::firstWhere('documento',$request->documento) || Cliente::firstWhere('documento',$request->documento)){
            return redirect(route('logi'))->with('error','Ya Tienes Una Cuenta');
        }
        elseif(User::firstWhere('email',$request->email) || Cliente::firstWhere('Email',$request->email)){
            return redirect(route('logi'))->with('error','Email Ya Registrado');
        }
        elseif (User::firstWhere('telefono',$request->telefono) || Cliente::firstWhere('Telefono',$request->telefono)){
            return redirect(route('logi'))->with('error','Telefono Ya Registrado');
        }
       $cliente = new Cliente();
        $cliente->documento = $request->documento;
        $cliente->Nombre = $request->nombre;
        $cliente->Apellido = $request->apellido;
        $cliente->Edad = $request->edad;
        $cliente->Direccion = $request->direccion;
        $cliente->Telefono = $request->telefono;
        $cliente->Email = $request->email;
        $cliente->contraseña = Hash::make($request->password);
        $cliente->Estado = "Activo";
        $cliente->save();
        Auth::guard('cliente')->login($cliente);
        return redirect(route('welcome'));
}


 



    //iniciar secion  cliente
   public function login(Request $request)
    {
        // Valida las credenciales
        $request->validate([
            'documento' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);
        //asigna credenciales
        $credentials = [
            "documento" =>  $request->documento,
            "Email" =>  $request->email,
            "password" => $request->password,
        ];          
        $cliente = Cliente::where('documento', $credentials['documento'])->first();
        if (!$cliente){
            return redirect(route('logi'))->with('error', 'El Cliente No Existe');
        }        
        if ($cliente->Estado == 'Inactivo') {
            return redirect(route('logi'))->with('error', 'Cliente Inactivo');
        }       
        
        if ($cliente->documento == $credentials['documento'] && $cliente->Email == $credentials['Email'] && $cliente->contraseña == $credentials['password']) {
            if (Auth::guard('cliente')->loginUsingId($cliente->id)) {
                return redirect(route('welcome'));
            }
            else{
                return redirect(route('logi'))->with('error','Ha Ocurrido Un Error');
            }
        }       
        else {
            return redirect(route('logi'))->with('error','Datos Incorrectos');
        }
    }


    //cerrar secion del cliente
    public function logout(request $request)
    {
        Auth::guard('cliente')->logout();
        session()->forget('carrito_' . md5(Auth::guard('cliente')->id()));
        return redirect(route('welcome'));
    }
}    
/***
     * 
     *CODIGO PARA ENVIAR LOS CORREOS ELECTRONICOS PARA VERIFICAR AL CLIENTE 
     */
   /* public function enviarCorreoVerificacion($email){
        $token = Str::random(60);

        $cliente = Cliente::where('Email', $email)->first();
    
        $cliente->email_verified_at = now();
        $cliente->save();
    
        $data = [
            'Nombre' => $cliente->nombre,
            'Email' => $cliente->email,
            'email_verified_at' => $token,
        ];
    
        Mail::to($email)->send(new Verified($data));
    }
    }
     ** */



