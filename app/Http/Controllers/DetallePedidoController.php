<?php

namespace App\Http\Controllers;
use App\Models\DetallePedido;
use App\Models\Producto;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Class DetallePedidoController
 * @package App\Http\Controllers
 */
class DetallePedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $productosActivos = Producto::where('Estado', 'Activo')->select('Nombre', 'id','imagen')->get();
        
        if (request()->input('pedi_id') || request()->input('id') || request()->input('pro_id') || request()->input('Estado') ){
            $detallePedidos = DetallePedido::query();            
            if (request()->input('pedi_id')){
                $detallePedidos->where('pedido_id','LIKE','%'. request()->input('pedi_id').'%' );
            }
            if (request()->input('id')){
                $detallePedidos->where('id','LIKE','%'. request()->input('id').'%' );
            }
            if (request()->input('pro_id')){
                $detallePedidos->where('producto_id','LIKE','%'. request()->input('pro_id').'%' );
            }
            if (request()->input('Estado')){
                $detallePedidos->where('Estado','LIKE','%'. request()->input('Estado').'%' );
            }
        $detallePedidos = $detallePedidos->paginate();
        return view('detalle-pedido.index', compact('detallePedidos','productosActivos'))
            ->with('i', (request()->input('page', 1) - 1) * $detallePedidos->perPage());
        }else{
                $detallePedidos = DetallePedido::paginate();
                return view('detalle-pedido.index', compact('detallePedidos','productosActivos'))
            ->with('i', (request()->input('page', 1) - 1) * $detallePedidos->perPage());
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
        $detallePedido = new DetallePedido();
        return view('detalle-pedido.create', compact('detallePedido','productosActivos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       if(DetallePedido::Where('pedido_id',$request->input('pedido_id'))->where('producto_id',$request->input('producto_id'))->first()){
        return redirect(route('detalle_pedido.index'))->with('error','El Pedido Ya Tiene El Producto');
       }
       elseif(!Pedido::Where('id',$request->input('pedido_id'))->first()){
        return redirect(route('detalle_pedido.index'))->with('error','El Pedido No Existe');
       }
       else{
        $detallePedido = DetallePedido::create([
            "Cantidad" => $request->input('Cantidad'),
            "Estado" => "Activo",
            "producto_id" => $request->input('producto_id'),
            "pedido_id" => $request->input('pedido_id')
        ]);
        $detallePedido->save();        
        return redirect()->route('detalle_pedido.index')
            ->with('success', 'DetallePedido created successfully.');
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
        $detallePedido = DetallePedido::find($id);
        $detallePedido->Estado = 'Inactivo';
        $detallePedido->save();
        return redirect()->route('detalle_pedido.index')->with('success','Inactivado Exitosamente');
    }
    public function activar($id)
    {
        $detallePedido = DetallePedido::find($id);
        $detallePedido->Estado = 'Activo';
        $detallePedido->save();
        return redirect()->route('detalle_pedido.index')->with('success','Activado Exitosamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detallePedido = DetallePedido::find($id);
        $productosActivos = Producto::where('Estado', 'Activo')->select('Nombre', 'id')->get();

        return view('detalle-pedido.edit', compact('detallePedido','productosActivos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  DetallePedido $detallePedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetallePedido $detallePedido)
    {
        $rules = DetallePedido::$rules;
        $rules['producto_id'] = ['required', Rule::unique('detalle_pedidos', 'producto_id')->ignore($detallePedido->id)];


        return redirect()->route('detalle_pedido.index')
            ->with('success', 'DetallePedido updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        
            $detallePedido= DetallePedido::find($id);
            $detallePedido->delete();
        return redirect()->route('detalle_pedido.index')
            ->with('success', 'Producto Eliminado Del Pedido Exitosamente');
        
    }
}
