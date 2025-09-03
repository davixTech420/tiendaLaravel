<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Cliente as Authenticatable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cliente
 *
 * @property $id
 * @property $documento
 * @property $Nombre
 * @property $Apellido
 * @property $Edad
 * @property $Direccion
 * @property $Telefono
 * @property $Email
 * @property $email_verified_at
 * @property $contraseña
 * @property $Estado
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Cliente extends Authenticatable implements MustVerifyEmail
{
  protected $table = 'clientes';

  static $rules = [
    'documento' => 'required|unique:clientes,documento',
    'Nombre' => 'required',
    'Apellido' => 'required',
    'Edad' => 'required',
    'Direccion' => 'required',
    'Telefono' => 'required|unique:clientes,Telefono',
    'Email' => 'required|unique:clientes,Email',
    'contraseña' => 'required',
    'Estado' => 'Activo',
  ];

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array/
   */
  protected $fillable = ['documento', 'Nombre','Apellido','Edad','Direccion','Telefono','Email','contraseña','Estado'];


 protected $casts = [
        'email_verified_at' => 'datetime',
    ];


}
