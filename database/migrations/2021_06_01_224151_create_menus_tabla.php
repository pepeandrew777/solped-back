<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('at_menus', function (Blueprint $table) {
            $table->increments('n_id_menu');
            $table->string('v_nombre', 150);
            $table->string('v_rastro', 150)->unique();
            $table->unsignedInteger('n_padre')->default(0);
            $table->smallInteger('n_orden')->default(0);
            $table->boolean('b_activado')->default(1);
            $table->string('v_icono', 50)->default('add_moderator');
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
        Schema::dropIfExists('at_menus');
    }
}
