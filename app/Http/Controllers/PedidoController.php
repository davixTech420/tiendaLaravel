<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cliente;
use Illuminate\Http\Request;
use JeroenNoten\LaravelAdminLte\View\Components\Form\Input;

/**
 * Class PedidoController
 * @package App\Http\Controllers
 */
class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->input('id') || request()->input('codi') || request()->input('Estado') ){
            $pedidos = Pedido::query();
            if(request()->input('id')){
                $pedidos->where('id','LIKE','%'.request()->input('id').'%' );
            }
            if(request()->input('codi')){
                $pedidos->where('cliente_id','LIKE','%'.request()->input('codi').'%' );
            }
            if(request()->input('Estado')){
                $pedidos->where('Estado','LIKE','%' . request()->input('Estado') . '%');
            }
            $pedidos = $pedidos->paginate();
        return view('pedido.index', compact('pedidos'))
            ->with('i', (request()->input('page', 1) - 1) * $pedidos->perPage());
        }
        else{
            $pedidos = Pedido::paginate();
            return view('pedido.index', compact('pedidos'))
            ->with('i', (request()->input('page', 1) - 1) * $pedidos->perPage());

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pedido = new Pedido();
        return view('pedido.create', compact('pedido'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Pedido::$rules);

        if (!Cliente::firstWhere('id',$request->cliente_id)){
            return redirect(route('pedidos.index'))->with('error','No Existe El Cliente');
        }

        $pedido = Pedido::create([
            "Estado" => 'Activo',
            "cliente_id" => $request->cliente_id,
        ]);

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function inactivar($id)
    {
        $pedido = Pedido::find($id);
        $pedido->Estado = 'Inactivo';
        $pedido->save();
        return redirect()->route('pedidos.index')->with('success','Pedido Inactivado Exitosamente');
    }
    public function activar($id)
    {
        $pedido = Pedido::find($id);
        $pedido->Estado = 'Activo';
        $pedido->save();
        return redirect()->route('pedidos.index')->with('success','Pedido Activado Exitosamente');

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pedido = Pedido::find($id);

        return view('pedido.edit', compact('pedido'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Pedido $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $pedido)
    {
        request()->validate(Pedido::$rules);
        if (!Cliente::find('id', $request->id)){
            return redirect(route('pedidos.index'))->with('error','No Existe El Cliente');
        }

        $pedido->update($request->all());

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $pedido = Pedido::find($id)->delete();

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido deleted successfully');
    }
}
