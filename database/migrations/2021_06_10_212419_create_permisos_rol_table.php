<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermisosRolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('at_permisos_rol', function (Blueprint $table) {
            $table->id('n_id_premiso');
            $table->bigInteger("n_id_menu")->unsigned();
            $table->bigInteger("n_id_rol")->unsigned();  
            $table->foreign("n_id_menu")->references("n_id_menu")->on("at_menus")->onDelete('Cascade');
            $table->foreign("n_id_rol")->references("n_id_rol")->on("at_roles")->onDelete('Cascade');
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
        Schema::dropIfExists('at_permisos_rol');
    }
}
