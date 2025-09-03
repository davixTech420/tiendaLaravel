<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Producto;
use Illuminate\Http\Request;

/**
 * Class ComentarioController
 * @package App\Http\Controllers
 */
class ComentarioController extends Controller
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
            $comentarios = Comentario::query();

            if (request()->input('codi')) {
                $comentarios->where('id', 'LIKE', '%' . request()->input('codi') . '%');
            }
            if (request()->input('cliente')) {
                $comentarios->where('cliente_id', 'LIKE', '%' . request()->input('cliente') . '%');
            }
            if (request()->input('pro_id')) {
                $comentarios->where('producto_id', 'LIKE', '%' .  request()->input('pro_id') . '%');
            }
            $comentarios = $comentarios->paginate();
        return view('comentario.index', compact('comentarios','productosActivos'))
            ->with('i', (request()->input('page', 1) - 1) * $comentarios->perPage());
    }
    else{
        $comentarios = Comentario::paginate();
        return view('comentario.index', compact('comentarios','productosActivos'))
        ->with('i', (request()->input('page', 1) - 1) * $comentarios->perPage());
    }
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productosActivos = Producto::Where('Estado','Activo')->select('Nombre','id')->get();
        $comentario = new Comentario();
        return view('comentario.create', compact('comentario','productosActivos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Comentario::$rules);

        $comentario = Comentario::create($request->all());

        return redirect()->route('comentario.index')
            ->with('success', 'Comentario created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comentario = Comentario::find($id);

        return view('comentario.show', compact('comentario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comentario = Comentario::find($id);
        $productosActivos = Producto::Where('Estado','Activo')->select('Nombre','id')->get();


        return view('comentario.edit', compact('comentario','productosActivos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Comentario $comentario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comentario $comentario)
    {
        request()->validate(Comentario::$rules);

        $comentario->update($request->all());

        return redirect()->route('comentario.index')
            ->with('success', 'Comentario updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $comentario = Comentario::find($id)->delete();

        return redirect()->route('comentario.index')
            ->with('success', 'Comentario deleted successfully');
    }
}
