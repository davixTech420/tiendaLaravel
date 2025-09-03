<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DetallePedido
 *
 * @property $id
 * @property $Cantidad
 * @property $Estado
 * @property $producto_id
 * @property $pedido_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Pedido $pedido
 * @property Producto $producto
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class DetallePedido extends Model
{
    
    static $rules = [
		'Cantidad' => 'required',
        'Estado' => 'Activo',
		'producto_id' => 'required||unique:detalles_pedidos,producto_id',
		'pedido_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Cantidad','Estado','producto_id','pedido_id'];






    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pedido()
    {
        return $this->hasOne('App\Models\Pedido', 'id', 'pedido_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function producto()
    {
        return $this->hasOne('App\Models\Producto', 'id', 'producto_id');
    }
    
    //ESTA FUNCION ES PARA QUE SE ACTULIZE LA CANTIDA DE PRODUCTOS EN EL PEDIDO CADA VEZ QUE SE CREA UN DETALLE DE PEDIDO
    protected static function booted()
    {
        static::saved(function ($detallePedido) {
            $pedido = Pedido::find($detallePedido->pedido_id);

            // Calcula la cantidad total de productos para el pedido
            $cantidadProductos = DetallePedido::where('pedido_id', $pedido->id)->sum('cantidad');

            // Actualiza el campo cantidad_productos
            $pedido->cantidad_productos = $cantidadProductos;
            $pedido->save();
        });
    }

}
