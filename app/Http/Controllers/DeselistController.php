<?php

namespace App\Http\Controllers;


use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Deselist;
use BackedEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class DeselistController
 * @package App\Http\Controllers
 */
class DeselistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productosActivos = Producto::where('Estado', 'Activo')->select('Nombre', 'id','imagen')->get();
        if (request()->input('codi') || request()->input('cliente') || request()->input('pro_id')) {
            // Si se están aplicando filtros, realizar la búsqueda
            $deseos = Deselist::query();
            if (request()->input('codi')) {
                $deseos->where('id', 'LIKE', '%' . request()->input('codi') . '%');
            }
            if (request()->input('cliente')) {
                $deseos->where('cliente_id', 'LIKE', '%' . request()->input('cliente') . '%');
            }
            if (request()->input('pro_id')) {
                $deseos->where('producto_id',request()->input('pro_id'));
            }
            $deselists = $deseos->paginate();
            return view('deselist.index', compact('deselists', 'productosActivos'))
                ->with('i', (request()->input('page', 1) - 1) * $deselists->perPage());
        } else {
            // Si no se aplican filtros, mostrar todos los registros
            $deselists = Deselist::paginate();
            return view('deselist.index', compact('deselists', 'productosActivos'))
                ->with('i', (request()->input('page', 1) - 1) * $deselists->perPage());
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productosActivos = Producto::where('Estado', 'Activo')->select('Nombre', 'id')->get();
        $deselist = new Deselist();
        return view('deselist.create', compact('deselist','productosActivos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Cliente::where('id',$request->cliente_id)->first() || CLiente::Where('Estado','Inactivo')->where('id',$request->cliente_id)->first()  ){
            return redirect(route('deselists.index'))->with('error','El Cliente No Existe O Esta Inactivo');
           }
        if (Deselist::where('cliente_id', $request->input('cliente_id'))
        ->where('producto_id', $request->input('producto_id'))
        ->first()) {
            return redirect(route('deselists.index'))->with('error','El Cliente Ya Tiene Agregado El Producto');
        }
        else{
        request()->validate(Deselist::$rules);
        $deselist = Deselist::create($request->all());
        return redirect()->route('deselists.index')
            ->with('success', 'Deseo Creado Exitosamente');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $deselist = Deselist::find($id)->delete();

        return redirect()->route('deselists.index')
            ->with('success', 'Deseo Eliminado Exitosamente');
    }




    /**/
    /* 
    FUNCION DE AÑADIR UN PRODUTO A LA LISTA DE DESEOS DEL CLIENTE
    */
    public function añadir($clien,$pro){
        if (!Auth::guard('cliente')->check()) {
            // El usuario no está autenticado, redirecciona  a la página de inicio de sesión
            return redirect()->route('login');
        }
        $dese  = new Deselist();
        $dese->cliente_id = $clien;
        $dese->producto_id = $pro;
        $dese->save();
        return back();
    }
     
    //funcion para eliminar un producto de la lista de deseos del cliente
    public function eliminar($cli,$pro) {
         
        $eli = Deselist::where('cliente_id',$cli)->where('producto_id',$pro)->delete();
        if ($eli){
            return back();
        }
        else
        {
            return redirect(route('welcome'))->with('error','Ha Ocurrido Un Error');
        }
    }






}
