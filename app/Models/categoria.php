<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Categoria
 *
 * @property $id
 * @property $Nombre
 * @property $Descripcion
 * @property $Estado
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Categoria extends Model
{
    
    static $rules = [
		'Nombre' => 'required||unique:categorias,Nombre',
		'Descripcion' => 'required',
		'Estado' => "Activo",
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Nombre','Descripcion','Estado'];
   
    
    public function productos(){
      return $this->hasMany(Producto::class);
    }



}
