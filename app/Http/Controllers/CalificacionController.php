<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;
use App\Models\Cliente;
use App\Models\Producto;
use Illuminate\Http\Request;

/**
 * Class CalificacionController
 * @package App\Http\Controllers
 */
class CalificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productosActivos = Producto::Where('Estado','Activo')->select('Nombre','id','imagen')->get();

            if (request()->input('codi') || request()->input('cliente') || request()->input('pro_id')) {
                // Si se están aplicando filtros, realizar la búsqueda
                $calificacions = Calificacion::query();

                if (request()->input('codi')) {
                    $calificacions->where('id', 'LIKE', '%' . request()->input('codi') . '%');
                }
                if (request()->input('cliente')) {
                    $calificacions->where('cliente_id', 'LIKE', '%' . request()->input('cliente') . '%');
                }
                if (request()->input('pro_id')) {
                    $calificacions->where('producto_id', 'LIKE', '%' .  request()->input('pro_id') . '%');
                }
                $calificacions = $calificacions->paginate();
        return view('calificacion.index', compact('calificacions','productosActivos'))
            ->with('i', (request()->input('page', 1) - 1) * $calificacions->perPage());
    }
    else{
        $calificacions = Calificacion::paginate();
        return view('calificacion.index', compact('calificacions','productosActivos'))
            ->with('i', (request()->input('page', 1) - 1) * $calificacions->perPage());
    }
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $calificacion = new Calificacion();
        $productosActivos = Producto::Where('Estado','Activo')->get();
            return view('calificacion.create', compact('calificacion','productosActivos'));
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Calificacion::$rules);



       if(!Cliente::where('id',$request->cliente_id)->first() || CLiente::Where('Estado','Inactivo')->where('id',$request->cliente_id)->first()  ){
        return redirect(route('calificacion.index'))->with('error','El Cliente No Existe O Esta Inactivo');
       }

        if (Calificacion::Where('producto_id',$request->producto_id)->where('cliente_id',$request->cliente_id)->first()) {
            return redirect(route('calificacion.index'))->with('error','El Cliente Ya Califico El Producto');
        }





        $calificacion = Calificacion::create($request->all());

        return redirect()->route('calificacion.index')
            ->with('success', 'Calificacion created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $calificacion = Calificacion::find($id);

        return view('calificacion.show', compact('calificacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $calificacion = Calificacion::find($id);
        $productosActivos = Producto::Where('Estado','Activo')->get();

        return view('calificacion.edit', compact('calificacion','productosActivos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Calificacion $calificacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Calificacion $calificacion)
    {
        request()->validate(Calificacion::$rules);
        if(!Cliente::where('id',$request->cliente_id)->first() || CLiente::Where('Estado','Inactivo')->where('id',$request->cliente_id)->first()  ){
            return redirect(route('calificacion.index'))->with('error','El Cliente No Existe O Esta Inactivo');
           }
        if(Calificacion::where('producto_id',$request->producto_id)->where('cliente_id',$request->cliente_id)->first()){
            return redirect(route('calificacion.index'))->with('error','El Cliente Ya Califico EL Producto');
        }
        $calificacion->update($request->all());
        return redirect()->route('calificacion.index')
            ->with('success', 'Calificacion updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $calificacion = Calificacion::find($id)->delete();
        return redirect()->route('calificacion.index')
            ->with('success', 'Calificacion deleted successfully');
    }
}
