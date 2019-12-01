<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->increments('id', 15);
            $table->char('cep', 9);
            $table->string('logradouro', 100);
            $table->char('numero', 10);
            $table->string('bairro', 100);
            $table->char('estado', 2);
            $table->string('complemento', 100)->nullable();
            $table->string('cidade', 50);
            $table->string('tp_residencia', 50);
            $table->string('pt_referencia', 100)->nullable();
            $table->unsignedInteger('cliente_id');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('cliente_id')
            ->references('id')
            ->on('clientes');
            
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enderecos');
    }
}
