<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\DetallePedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

/**
 * Class ProductoController
 * @package App\Http\Controllers
 */
class ProductoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoriasActivas = Categoria::where('Estado', 'Activo')->select('Nombre', 'id')->get();
        // Verificar si se están aplicando filtros de búsqueda
        if (request()->input('id') || request()->input('Nombre') || request()->input('Marca') || request()->input('Precio') || request()->input('stock') || request()->input('categoria_id') || request()->input('Estado')) {
            // Si se están aplicando filtros, realizar la búsqueda
            $producto = Producto::query();

            if (request()->input('id')) {
                $producto->where('id', 'LIKE', '%' . request()->input('id') . '%');
            }
            if (request()->input('Marca')) {
                $producto->where('Marca', 'LIKE', '%' . request()->input('Marca') . '%');
            }
            if (request()->input('Nombre')) {
                $producto->where('Nombre', 'LIKE', '%' .  request()->input('Nombre') . '%');
            }
            if (request()->input('Precio')) {
                $producto->where('Precio', 'LIKE', '%' . request()->input('Precio') . '%');
            }

            if (request()->input('stock')) {
                $producto->where('stock', 'LIKE', '%' . request()->input('stock') . '%');
            }

            if (request()->input('categoria_id')) {
                $producto->where('categoria_id', request()->input('categoria_id'));
            }

            if (request()->input('Estado')) {
                $producto->where('Estado', 'LIKE', request()->input('Estado'));
            }
            $producto = $producto->paginate();

            return view('producto.index', compact('producto', 'categoriasActivas'))
                ->with('i', (request()->input('page', 1) - 1) * $producto->perPage());
        } else {
            // Si no se aplican filtros, mostrar todos los registros
            $producto = Producto::paginate();

            return view('producto.index', compact('producto', 'categoriasActivas'))
                ->with('i', (request()->input('page', 1) - 1) * $producto->perPage());
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoriasActivas = Categoria::where('Estado', 'Activo')->pluck('Nombre', 'id');
        $producto = new Producto();
        return view('producto.create', compact('producto', 'categoriasActivas'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Producto::firstWhere('Nombre',$request->input('Nombre'))){
            return redirect(route('productos.index'))->with('error','El Producto Ya Existe');
        }
        request()->validate(Producto::$rules);
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $mime_tipe = $imagen->getMimeType();

            if (!in_array($mime_tipe,['image/jpeg' ,'image/jpg', 'image/png'])) {
                return redirect(route('productos.index'))->with('error', 'El Formato De La Imagen   No Es Valido');
            }



            $ruta = "imagenes/productos/";
            $subida = $imagen->move($ruta);
        }
        $producto = Producto::create([
            'Nombre' => $request->input('Nombre'),
            'Marca' => $request->input('Marca'),
            'descripcion' => $request->input('descripcion'),
            'Precio' => $request->input('Precio'),
            'Stock' => $request->input('stock'),
            'Estado' => "Activo",
            'categoria_id' => $request->input('categoria_id'),
            'imagen' => $subida,
        ]);
        $producto->save();
        return redirect()->route('productos.index')
            ->with('success', 'Producto Creado Exitosamente.');
    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function inactivar($id)
    {
        if (DetallePedido::firstWhere('producto_id', $id)) {
            return redirect(route('productos.index'))->with('error', 'Tiene Un Pedido En Proceso');
        }
        
        $producto = Producto::find($id);
        $producto->Estado = 'Inactivo';
        $producto->save();
        return redirect()->route('productos.index')->with('success', 'Producto Inactivado Exitosamente');
    }



    public function activar($id)
    {
        $producto = Producto::find($id);
        $producto->Estado = 'Activo';
        $producto->save();
        return redirect()->route('productos.index')->with('success', 'Producto Axtivo Exitosamente');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoriasActivas = Categoria::where('Estado', 'Activo')->pluck('Nombre', 'id');
        $producto = Producto::find($id);
        $imag = Producto::findOrFail($id);
        return view('producto.edit', compact('producto', 'categoriasActivas', 'imag'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Producto $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        request()->validate(Producto::$rules);

        $request->validate([
            'imagen' => 'nullable',
        ]);
        if ($request->hasFile('imagNew')) {
            $imagen = $request->file('imagNew');
            $mime_tipe = $imagen->getMimeType();
            if (!in_array($mime_tipe,['image/jpeg' ,'image/jpg', 'image/png'])) {
                return redirect(route('productos.index'))->with('error', 'El Formato De La Imagen   No Es Valido');
            }
            $ruta = "imagenes/productos/";
            $subida = $imagen->move($ruta);
            unlink($producto->imagen);
            $producto->imagen = $subida;
        } else {
            $producto->imagen = $producto->imagen;
        }
        $producto->update([
            "Nombre" => $request->input('Nombre'),
            'Marca' => $request->input('Marca'),
            'descripcion' => $request->input('descripcion'),
            "Precio" => $request->input('Precio'),
            "Stock" => $request->input('stock'),
            "Estado" => "Activo",
            "categoria_id" => $request->input('categoria_id'),
            'imagen' => $producto->imagen,
        ]);
       $producto->save();
        return redirect()->route('productos.index')->with('success', 'Producto Modificado Exitosamente');
    }
    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $producto = Producto::find($id);
        if ($producto->Estado == 'Activo') {
            return redirect()->route('productos.index')->with('error', 'Producto Activo');
        } elseif (DetallePedido::firstWhere('producto_id', $id)) {
            return redirect(route('productos.index'))->with('error', 'Tiene Un Pedido En Proceso');
        } else {
            unlink($producto->imagen);
            $producto->delete();
            return redirect()->route('productos.index')
                ->with('success', 'Producto Eliminado Exitosamente');
        }
    }
}
