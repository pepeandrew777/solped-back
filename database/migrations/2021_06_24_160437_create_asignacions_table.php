<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('at_asignaciones', function (Blueprint $table) {
            $table->increments('n_id_asignacion');
            $table->bigInteger("n_id")->unsigned();
            $table->bigInteger("n_id_vehiculo")->unsigned();  
            $table->foreign("n_id")->references("n_id")->on("at_usuarios")->onDelete('Cascade');
            $table->foreign("n_id_vehiculo")->references("n_id_vehiculo")->on("at_vehiculo")->onDelete('Cascade');
            $table->string('v_apiestado')->default('ELABORADO');
            $table->dateTime('d_creacion')->default(now());
            $table->dateTime('d_asignacion')->nullable();
            $table->text('t_observacion_asignacion');            
            $table->dateTime('d_devolucion')->nullable();
            $table->text('t_observacion_devolucion')->nullable();
            $table->dateTime('d_actualizacion')->nullable();
            $table->text('t_observacion_actualizacion')->nullable();
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
        Schema::dropIfExists('at_asignaciones');
    }
}
