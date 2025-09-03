<?php

namespace App\Models;

 use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Validation\Rule;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
        public static $rules = [
            'documento' => 'required|unique:users,documento',
            'name' => 'required|alpha|max:15',
            'apellido' => 'required|max:15',
            'email' => 'required|email|unique:users,email',
            'telefono' => 'required|max:10|min:10|unique:users',
            'direccion' => 'required',
            'password' => 'required|string|max:200',
            'Estado' => 'Activo',
            // Agrega más reglas según tus necesidades
        ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'documento',
        'name',
        'apellido',
        'email',
        'telefono',
        'direccion',
        'password',
        'Estado',
        'google_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
