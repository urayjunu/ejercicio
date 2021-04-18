<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 100)->nullable();
            $table->string('email', 190)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 190);
            $table->integer('numero_celular')->nullable();
            $table->string('cedula',11);
            $table->date('fecha_nacimiento');
            $table->integer('ciudad_id')->nullable();
            $table->rememberToken();
            $table->timestamps();

        });
    }

 

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
