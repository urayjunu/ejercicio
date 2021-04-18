<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {  
        
        $message = array(
            'nombre.required' => 'El nombre es obliglario, llene el campo por favor',
            'nombre.max' => 'Su nombre paso la cantiad maxima de letrar que es de 100.',
            'email.required' => 'El correo es obligatorio, llene el campo por favor.',
            'email.unique' => 'El correo electrónico ingresado ya exite, verifique su correo por favor.',
            'password.required' => 'La contraseña es obligatorio, llene el campo por favor.',
            'password.min' => 'La cantidad minima de letras deber ser 8.',
            'password.confirmed' => 'La contraseña no coincide con la confirmación.',
            'password_confirmation.required' => 'Es obligario que confirme su contraseña.',
            'password_confirmation.same' => 'La contraseña y confirmación de contraseña no coinciden',
            'numero_celular.max' => 'El número de celuar sobre paso los 10 digitos.',
            'cedula.required' => 'La cedula es obligatorio.',
            'cedula.max' => 'La cedula debe tener maximo 11 digitos.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatorio.',
            'fecha_nacimiento.before' => 'El usuario debe mayor a 18 años.',
           // 'ciudad_id.required' => 'La ciudad es obligatorio.',
     
        );
        return Validator::make($data, [
            'nombre' => 'required|string|max:100',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'numero_celular' => 'numeric|max:1000000000',
            'cedula' => 'required|string|max:11',
            'fecha_nacimiento' => 'required|date|before:-18 years',

           // 'ciudad_id' => 'required|numeric',
        ], $message);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    { 
        $user = User::create([
            'nombre' => $data['nombre'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'numero_celular' => $data['numero_celular'],
            'cedula' => $data['cedula'],
            'fecha_nacimiento' => $data['fecha_nacimiento'],
            'rol' =>  'usuario',
             //'ciudad_id' => $data['ciudad_id'],

        ]);

       
        return $user;
    }
}
