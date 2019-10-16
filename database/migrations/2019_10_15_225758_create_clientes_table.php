<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id', 15);
            $table->string('nome', 100);
            $table->string('email', 50);
            $table->boolean('ativo');
            $table->unsignedInteger('endereco_id');          
            $table->unsignedInteger('telefone_id');           
            $table->unsignedInteger('pf_id');            
            $table->unsignedInteger('pj_id');
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
        Schema::dropIfExists('clientes');
    }
}
