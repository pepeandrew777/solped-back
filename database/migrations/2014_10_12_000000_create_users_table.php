<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('at_usuarios', function (Blueprint $table) {
            $table->id('n_id');
            $table->string('v_usuario')->unique();
            $table->string('v_nombres');
            $table->string('v_apellido_paterno');
            $table->string('v_apellido_materno');
            $table->string('v_cargo');
            $table->string('v_ci');
            $table->string('v_email')->unique();           
            $table->string('v_password');
            $table->string('v_apiestado')->default('ELABORADO');
            $table->dateTime('d_creacion')->default(now());
            $table->dateTime('d_actualizacion')->nullable();
            $table->dateTime('d_eliminacion')->nullable();
            $table->rememberToken();
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('at_usuarios');
    }
}
