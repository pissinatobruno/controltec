<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdemServicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordem_servico', function (Blueprint $table) {
            $table->increments('id', 15);
            $table->char('numero_os', 15);
            $table->date('data_execucao');
            $table->string('descricao_servico', 255)->nullable();
            $table->date('data_solicitacao');
            $table->unsignedInteger('status_id');
            $table->unsignedInteger('equipamento_id');
            $table->unsignedInteger('servico_id');
            $table->unsignedInteger('agendamento_id');
            $table->unsignedInteger('funcionario_id');
            $table->boolean('ativo');               
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordem_servico');
    }
}
