<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculoMotorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('at_vehiculo_motor', function (Blueprint $table) {
            $table->increments('n_id_motor');           
            $table->bigInteger("n_id_vehiculo")->unsigned();
            $table->foreign("n_id_vehiculo")->references("n_id_vehiculo")->on("at_vehiculo")->onDelete('Cascade');
            $table->string('v_num_motor');
            $table->string('v_tipo_motor');
            $table->string('v_codigo_motor');
            $table->integer('n_cilindrada')->default(0);
            $table->string('v_tipo_alimentacion');
            $table->string('v_disp_cilindros');
            $table->integer('n_cilindros')->default(0);
            $table->string('v_sobrealimentado');
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
        Schema::dropIfExists('at_vehiculo_motor');
    }
}
