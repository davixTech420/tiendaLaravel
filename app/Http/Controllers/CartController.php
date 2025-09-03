<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
class CartController extends Controller
{
    public function addCart($id){
        if (!Auth::guard('cliente')->check()) {
            return redirect()->route('login');
        } else {
            $cli = Auth::guard('cliente')->user();
            $producto = Producto::findOrFail($id);
            // Obtener el carrito actual del cliente desde la sesión
            $cartKey = 'carrito_' . md5($cli->id);
            $cart = session()->get($cartKey, []);
            // Verificar si el producto ya existe en el carrito
            $productoEnCarrito = false;
            foreach ($cart as &$item) {
                if ($item['producto_id'] == $producto->id){
                    $item['cantidad']++;
                    $productoEnCarrito = true;
                    break;
                }
            }
            // Si el producto no existe en el carrito, lo agregamos
            if (!$productoEnCarrito) {
                $nuevoItem = [
                    'producto_id' => $producto->id,
                    'cantidad' => 1,
                    'cliente_id' => $cli->id
                ];
                $cart[] = $nuevoItem;
            }
            // Guardar el carrito actualizado en la sesión
            session([$cartKey => $cart]);
            return back();
        }
    }
    public function deleCart(){
        session()->forget('carrito_'.md5(Auth::guard('cliente')->user()->id));
        return back();
    }
}