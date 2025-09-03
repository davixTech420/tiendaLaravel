<?php

namespace App\Models;

use App\Models\DetallePedido;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pedido
 *
 * @property $id
 * @property $Estado
 * @property $cliente_id
 * @property $created_at
 * @property $updated_at
 * @property Cliente $cliente
 * @property DetallePedido[] $detallePedidos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Pedido extends Model
{
    
    static $rules = [
		'Estado' => 'required',
		'cliente_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Estado','cliente_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cliente()
    {
        return $this->hasOne('App\Models\Cliente', 'id', 'cliente_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detallePedidos()
    {
        return $this->hasMany('App\Models\DetallePedido', 'pedido_id', 'id');
    }




    

}
