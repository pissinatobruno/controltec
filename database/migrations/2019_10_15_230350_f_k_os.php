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
        Schema::table('ordens_de_servicos', function (Blueprint $table){
        
            $table->foreign('status_id')
                ->references('id')
                ->on('status');
            $table->foreign('equipamento_id')
                ->references('id')
                ->on('equipamentos');
            $table->foreign('servico_id')
                ->references('id')
                ->on('servicos');
            $table->foreign('agendamento_id')
                ->references('id')
                ->on('agendamentos');
            $table->foreign('funcionario_id')
                ->references('id')
                ->on('funcionarios');
            
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
