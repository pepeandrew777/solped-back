<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('at_vehiculo_imagenes', function (Blueprint $table) {
            $table->increments('n_id_imagen');    
            $table->bigInteger("n_id_vehiculo")->unsigned();
            $table->foreign("n_id_vehiculo")->references("n_id_vehiculo")->on("at_vehiculo");
            $table->string('v_nombre');
            $table->string('v_ruta');
            $table->text('v_observaciones');           
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
        Schema::dropIfExists('at_vehiculo_imagenes');
    }
}
