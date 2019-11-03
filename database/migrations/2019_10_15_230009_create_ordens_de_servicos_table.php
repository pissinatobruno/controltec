<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdensDeServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordens_de_servicos', function (Blueprint $table) {
            $table->increments('id', 15);
            $table->char('numero_os', 15);
            $table->date('data_execucao');
            $table->string('descricao_servico', 255)->nullable();
            $table->date('data_solicitacao');
            $table->unsignedInteger('status_id');
            $table->unsignedInteger('equipamento_id');
            $table->unsignedInteger('servico_id');
            $table->unsignedInteger('agendamento_id');
            $table->unsignedInteger('tecnico_id');
            $table->unsignedInteger('auxiliars_id');              
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordens_de_servicos');
    }
}
