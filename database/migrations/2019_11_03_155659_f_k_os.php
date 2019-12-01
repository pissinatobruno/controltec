<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FKOs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('os', function (Blueprint $table){
        
            $table->foreign('cliente_id')
                ->references('id')
                ->on('clientes');
            $table->foreign('status_id')
                ->references('id')
                ->on('statuses');
            $table->foreign('servico_id')
                ->references('id')
                ->on('servicos');
            $table->foreign('tecnico_id')
                ->references('id')
                ->on('tecnicos');
            $table->foreign('auxiliar_id')
                ->references('id')
                ->on('auxiliars');    
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
