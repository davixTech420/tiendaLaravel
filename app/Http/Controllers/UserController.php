<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cliente;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use FPDF;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Verificar si se están aplicando filtros de búsqueda
        $nombre = request()->input('nombre');

        if (request()->input('id') || request()->input('documento') || $nombre || request()->input('Estado') || request()->input('telefono') || request()->input('email') || request()->input('apellido')) {
            // Si se están aplicando filtros, realizar la búsqueda
            $users = User::query();
            if (request()->input('id')){
                $users->where('id','LIKE', '%'.request()->input('id'). '%');
            }

            if (request()->input('documento')) {
                $users->where('documento', 'LIKE', '%' . request()->input('documento') . '%');
            }

            if ($nombre) {
                $users->where('name', 'LIKE', '%' .  $nombre . '%');
            }
            if (request()->input('apellido')) {
                $users->where('apellido', 'LIKE', '%' . request()->input('apellido') . '%');
            }

            if (request()->input('Estado')) {
                $users->where('Estado', 'LIKE', '%' . request()->input('Estado') . '%');
            }

            if (request()->input('telefono')) {
                $users->where('telefono', 'LIKE', '%' . request()->input('telefono') . '%');
            }

            if (request()->input('email')) {
                $users->where('email', 'LIKE', '%' . request()->input('email') . '%');
            }
            $users = $users->paginate();
            return view('user.index', compact('users'))
                ->with('i', (request()->input('page', 1) - 1) * $users->perPage());
        } else {
            // Si no se aplican filtros, mostrar todos los registros
            $users = User::paginate();
            return view('user.index', compact('users'))
                ->with('i', (request()->input('page', 1) - 1) * $users->perPage());
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        return view('user.create', compact('user'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(Cliente::firstWhere('documento',$request->input('documento'))){
            return redirect(route('users.index'))->with('error','Documento Ya Registrado En El Sistema');
        }elseif(Cliente::firstWhere('Telefono',$request->input('telefono'))){
            return redirect(route('users.index'))->with('error','Telefono Ya Registrado En El Sistema');
        }elseif(Cliente::firstWhere('Email',$request->input('email'))){
            return redirect(route('users.index'))->with('error','Email Ya Registrado En El Sistema');
        }
        else{


        request()->validate(User::$rules);
        $user = User::create([
            'documento' => $request->input('documento'),
            'name' => $request->input('name'),
            'apellido' => $request->input('apellido'),
            'email' => $request->input('email'),
            'telefono' => $request->input('telefono'),
            'direccion' => $request->input('direccion'),
            'password' => $request->input('password'),
            'Estado' => "Activo",
        ]);
        $user->save();
        return redirect()->route('users.index')
            ->with('success', 'Administrador Creado Exitosamente.');
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    //INACTIVAR EL ESTADO DEL ADMINISTRADOR
    public function inactivar($id)
    {
        $user = User::find($id);
        if (auth()->user() && auth()->user()->id == $id) {
            return redirect()->route('users.index')->with('error', 'Administrador En Uso');
        } else {
            $user->Estado = 'Inactivo';
            $user->save();
            return redirect()->route('users.index')->with('success', 'Inactivado Exitosamente');
        }
    }

    //ACTIVAR EL ESTADO DEL ADMINISTRADOR
    public function activar($id)
    {
        $user = User::find($id);
        $user->Estado = "Activo";
        $user->save();
        return redirect()->route('users.index')->with('success', "Administrador Activado Exitosamente");
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = User::$rules;
        $rules['documento'] = ['required', Rule::unique('users', 'documento')->ignore($user->id)];
        $rules['email'] = ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)];
        $rules['telefono'] = ['required', 'max:10', 'min:10', Rule::unique('users', 'telefono')->ignore($user->id)];
        // Valida la solicitud con las reglas modificadas
        $request->validate($rules);
        $user->update([
            "documento" => $request->input('documento'),
            "name" => $request->input('name'),
            'apellido' => $request->input('apellido'),
            'email' => $request->input('email'),
            'telefono' => $request->input('telefono'),
            'direccion' => $request->input('direccion'),
            'password' => $request->input('password'),
            'Estado' => "Activo",
        ]);
        $user->save();
        return redirect()->route('users.index')
            ->with('success', 'Administrador Modificado Exitosamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (auth()->user() && auth()->user()->id == $id) {
            return redirect()->route('users.index')->with('error', 'Administrador En Uso');
        } elseif ($user->Estado == 'Activo') {
            return redirect()->route('users.index')->with('error', 'Administrador Activo No Se Puede Eliminar');
        } else {
            $user->delete();
            return redirect()->route('users.index')
                ->with('success', 'Administrador Eliminado Exitosamente');
        }
    }
}
