<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use GuzzleHttp\RedirectMiddleware;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Class CategoriaController
 * @package App\Http\Controllers
 */
class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->input('id') || request()->input('Nombre') || request()->input('Estado')) {
            $categorias = Categoria::query();
            if (request()->input('id')) {
                $categorias->where('id', 'LIKE', '%' . request()->input('id') . '%');
            }
            if (request()->input('Nombre')) {
                $categorias->where('Nombre', 'LIKE', '%' .  request()->input('Nombre') . '%');
            }
            if (request()->input('Estado')) {
                $categorias->where('Estado', 'LIKE', '%' . request()->input('Estado') . '%');
            }
            $categorias = $categorias->paginate();
            return view('categoria.index', compact('categorias'))
                ->with('i', (request()->input('page', 1) - 1) * $categorias->perPage());
        }
        else{
            $categorias = Categoria::paginate();
            return view('categoria.index', compact('categorias'))
                ->with('i', (request()->input('page', 1) - 1) * $categorias->perPage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoria = new Categoria();
        return view('categoria.create', compact('categoria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Categoria::firstWhere('Nombre',$request->input('Nombre'))){
            return redirect(route('categoria.index'))->with('error','La Categoria Ya Existe');
        }


        request()->validate(Categoria::$rules);
        $categoria = Categoria::create([

            'Nombre' => $request->input('Nombre'),
            'Descripcion' => $request->input('Descripcion'),
            'Estado' => "Activo",
        ]);

        $categoria->save();
        return redirect()->route('categoria.index')
            ->with('success', 'Categoria Creada Exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function inactivar($id)
    {
        $categoria = Categoria::find($id);
        if (Producto::where('categoria_id', $categoria->id)->first()) {
            return redirect()->route('categoria.index')->with('error', 'Productos Registrados');
        } else {
            $categoria->Estado = 'Inactivo';
            $categoria->save();
            return redirect()->route('categoria.index')->with('success', 'Se Ha Inactivado Exitosamente');
        }
    }
    public function activar($id)
    {
        $categoria = Categoria::find($id);
        $categoria->Estado = 'Activo';
        $categoria->save();
        return redirect()->route('categoria.index')->with('success', 'Se Ha Activado Exitosamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = Categoria::find($id);

        return view('categoria.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Categoria $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        
        $rules = Categoria::$rules;
        $rules['Nombre'] = ['required', Rule::unique('categoria', 'Nombre')->ignore($categoria->id)];

        

        // Actualiza la categoría existente con los datos del formulario
        $categoria->update([
            'Nombre' => $request->input('Nombre'),
            'Descripcion' => $request->input('Descripcion'),
            'Estado' => "Activo",
        ]);

        return redirect()->route('categoria.index')
            ->with('success', 'Categoría Modificada Exitosamente');
    }


    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $categoria = Categoria::find($id);
        if ($categoria->Estado == 'Activo') {
            return redirect()->route('categoria.index')->with('error', 'Categoria Axtiva');
        } else {
            $categoria->delete();
            return redirect()->route('categoria.index')
                ->with('success', 'Categoria Eliminada Exitosamente');
        }
    }
}
