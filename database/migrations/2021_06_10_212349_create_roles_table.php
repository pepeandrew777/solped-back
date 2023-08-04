<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('at_roles', function (Blueprint $table) {
            $table->increments('n_id_rol');
            $table->string('v_nombre_rol', 50);
            $table->string('v_nombre_mostrar_rol', 50);
            $table->text('v_descripcion_rol');
            $table->string('v_apiestado')->default('ELABORADO');
            $table->dateTime('d_creacion')->default(now());
            $table->dateTime('d_actualizacion')->nullable();
            $table->dateTime('d_eliminacion')->nullable();        
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('at_roles');
    }
}
