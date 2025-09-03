<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Deselist;
use App\Models\Producto;
use App\Models\DetallePedido;

class WelcomeController extends Controller
{
    //
    //vista inicial el index de la pagina
    public function index()
    {        
        $idCliente = Auth::guard('cliente')->id();
        $categoriasActivas = Categoria::where('Estado', 'Activo')->select('Nombre', 'id')->with('productos')->get();
        $produc = Producto::where('Estado', 'Activo')->get();
        $newpro = Producto::where('Estado','Activo')->where('created_at', '>', now()->subDays(30))->get();
        $enListaDeDeseos = Deselist::where('cliente_id', $idCliente)->pluck('producto_id')->toArray();
        return view('/welcome', compact('categoriasActivas', 'produc', 'enListaDeDeseos','newpro'));
    }
    //Ver vista item para ver el producto en especifico
    public function item($id)
    {
        if (!Producto::firstWhere('id',$id)){
            return back();
        }
        $idCliente = Auth::guard('cliente')->id();
        $producto = Producto::find($id);
        $categoriasActivas = Categoria::where('Estado', 'Activo')->select('Nombre', 'id')->get();
        $newpro = Producto::where('categoria_id', $producto->categoria_id)->get();
        $enListaDeDeseos = Deselist::where('cliente_id', $idCliente)->pluck('producto_id')->toArray();
        return view('visven.item', compact('categoriasActivas', 'newpro', 'producto','enListaDeDeseos'));
    }
    public function wishlist(){
        $id  = Auth::guard('cliente')->user()->id;
        if (!$id) {
            return redirect(route('logi'));
        }
        $dese = Deselist::where('cliente_id', $id)->get();
        $producto = Producto::findMany($dese->pluck('producto_id')->toArray());
        return view('visven.wishlist', compact('producto'));
    }

    public function veriCORRE(){
        return view('visven.emailverify');
    }



    // vista del login para los clientes 
    public function login()
    {
        return view('auth.loginCLI');
    }

    //vista para ver el contenido del carrito de compras
    public function carrito()
    {
        $cliente = session('carrito_'.md5(Auth::guard('cliente')->user()->id));
        $pro = Producto::whereIn('id',array_column($cliente,'producto_id'))->get();
        return view('visven.carrito',compact('cliente','pro'));    
    }
}
