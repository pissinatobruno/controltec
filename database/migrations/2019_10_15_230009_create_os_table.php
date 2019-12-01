<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('os', function (Blueprint $table) {
            $table->increments('id', 15);
            $table->char('numero_os', 15);
            $table->date('data_execucao');
            $table->string('descricao_servico', 255)->nullable();
            $table->date('data_vencimento');
            $table->unsignedInteger('cliente_id'); 
            $table->unsignedInteger('status_id');  
            $table->unsignedInteger('servico_id');
            $table->unsignedInteger('tecnico_id');
            $table->unsignedInteger('auxiliar_id');
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
        Schema::dropIfExists('os');
    }
}
