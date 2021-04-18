<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'email', 'password','numero_celular','cedula','fecha_nacimiento','ciudad_id','rol',


    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     public static $messages = [ 
            'nombre.required' => 'El nombre es obliglario, llene el campo por favor',
            'nombre.max' => 'Su nombre paso la cantiad maxima de letrar que es de 100.',
            'numero_celular.max' => 'El número de celuar sobre paso los 10 digitos.',


        ];
    
    public static  $rules = [
            'nombre' => 'required|string|max:100',
            'numero_celular' => 'numeric|max:1000000000',
        ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
   

}
