<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->nombre = 'alex';
        $user->rol = 'admin';
        $user->email = 'alejandrocien1@gmail.com';
        $user->password = bcrypt('123456');
        $user->numero_celular = '523456789';
        $user->cedula = '1234567891';
        $user->fecha_nacimiento = '2001-04-16';
        $user->ciudad_id = '1';

        $user->save();
        
    }
}