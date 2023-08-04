<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculoSuspensionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('at_vehiculo_suspension', function (Blueprint $table) {
            $table->increments('n_id_suspension');           
            $table->bigInteger("n_id_vehiculo")->unsigned()->unique();
            $table->foreign("n_id_vehiculo")->references("n_id_vehiculo")->on("at_vehiculo")->onDelete('Cascade');
            $table->string('v_fre_delantero');
            $table->string('v_fre_trasero');
            $table->string('v_suspension_delantera');
            $table->string('v_suspension_trasero');
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
        Schema::dropIfExists('at_vehiculo_suspension');
    }
}
