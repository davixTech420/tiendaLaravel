<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Producto
 *
 * @property $id
 * @property $Nombre
 * @property $Marca
 * @property $descripcion
 * @property $Precio
 * @property $Stock
 * @property $Estado
 * @property $categoria_id
 * @property $imagen
 * @property $created_at
 * @property $updated_at
 *
 * @property Categoria $categoria
 * @property DetallePedido[] $detallePedidos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Producto extends Model
{
    
    static $rules = [
		'Nombre' => 'required',
        'Marca' => 'required',
        'descripcion' => 'required',
		'Precio' => 'required',
		'stock' => 'required',
        'Estado' => 'Activo',
        'categoria_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Nombre','Marca','descripcion','Precio','Stock','Estado','categoria_id','imagen'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function categoria()
    {
        return $this->hasOne('App\Models\Categoria', 'id', 'categoria_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detallePedidos()
    {
        return $this->hasMany('App\Models\DetallePedido', 'producto_id', 'id');
    }
    public function imagen(){
        return $this->hasOne('App\Models\Producto'); 
        
    }

    

}
