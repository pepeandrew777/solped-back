<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class Vehiculo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public $table = "at_vehiculo";
    public function up()
    {
        if ( Schema::hasTable("at_vehiculo") ) {
            $this->down();
            Schema::create("at_vehiculo", function (Blueprint $table) {               
                $table->increments('n_id_vehiculo');
				$table->string('v_placa_control');
				$table->string('v_num_activo_fijo');
                $table->string('v_marca');
                $table->string('v_modelo');
                $table->string('v_codigo');
                $table->integer('n_anio');
                $table->integer('n_anio_puesta_marcha');
                $table->integer('v_anio_detener');
                $table->string('v_tipo');
                $table->string('v_subtipo');
                $table->string('v_estado_funcional');
                $table->string('v_apiestado')->default('DISPONIBLE');
                $table->dateTime('d_creacion')->default(now());
                $table->dateTime('d_actualizacion')->nullable();
                $table->dateTime('d_eliminacion')->nullable();        
                $table->softDeletes();
            });
        }
        else{
            Schema::create("at_vehiculo", function (Blueprint $table) {
                $table->increments('n_id_vehiculo');
				$table->string('v_placa_control');
				$table->string('v_num_activo_fijo');
				$table->string('v_marca');
                $table->string('v_modelo');
                $table->string('v_codigo');
                $table->integer('n_anio');
                $table->integer('n_anio_puesta_marcha');
                $table->integer('v_anio_detener');
                $table->string('v_tipo');
                $table->string('v_subtipo');
                $table->string('v_estado_funcional');
                $table->string('v_apiestado')->default('ELABORADO');
                $table->dateTime('d_creacion')->default(now());
                $table->dateTime('d_actualizacion')->nullable();
                $table->dateTime('d_eliminacion')->nullable();       
               // $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('at_vehiculo');
    }
}
