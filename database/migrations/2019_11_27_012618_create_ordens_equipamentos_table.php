<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdensEquipamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('OrdensEquipamentos', function (Blueprint $table) {
            $table->unsignedInteger('equipamento_id');
            $table->foreign('equipamento_id')
                ->references('id')
                ->on('equipamentos');
            $table->unsignedInteger('os_id');   
            $table->foreign('os_id')
                ->references('id')
                ->on('os');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('OrdensEquipamentos');
    }
}
