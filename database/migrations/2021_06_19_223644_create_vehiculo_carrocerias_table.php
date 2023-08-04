<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculoCarroceriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('at_vehiculo_carroceria', function (Blueprint $table) {
           
                $table->increments('n_id_carroceria');           
                $table->bigInteger("n_id_vehiculo")->unsigned()->unique();
                $table->foreign("n_id_vehiculo")->references("n_id_vehiculo")->on("at_vehiculo")->onDelete('Cascade');
                $table->string('v_chasis');
                $table->string('v_color');
                $table->integer('n_plazas')->default(0);
                $table->integer('n_cap_carga')->default(0);
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
        Schema::dropIfExists('at_vehiculo_carroceria');
    }
}
