<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cupone
 *
 * @property $id
 * @property $cupon
 * @property $descuento
 * @property $fec_ini
 * @property $fec_fin
 * @property $mul_usos
 * @property $cantidad
 * @property $categorias
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Cupone extends Model
{
    
    static $rules = [
		'cupon' => 'required',
		'descuento' => 'required',
		'fec_ini' => 'required',
		'fec_fin' => 'required',
		'mul_usos' => 'required',
		'cantidad' => 'required',
		'categorias' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['cupon','descuento','fec_ini','fec_fin','mul_usos','cantidad','categorias','estado'];
   



}
