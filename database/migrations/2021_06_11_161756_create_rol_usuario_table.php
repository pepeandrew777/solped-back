<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('at_rol_usuario', function (Blueprint $table) {
            $table->id('n_id_rolusuario');
            $table->bigInteger("n_id")->unsigned();
            $table->bigInteger("n_id_rol")->unsigned();  
            $table->foreign("n_id")->references("n_id")->on("at_usuarios");
            $table->foreign("n_id_rol")->references("n_id_rol")->on("at_roles");
            $table->string('v_apiestado')->default('ELABORADO');
            $table->dateTime('d_creacion')->default(now());
            $table->dateTime('d_actualizacion')->nullable();
            $table->dateTime('d_eliminacion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rol_usuario');
    }
}
