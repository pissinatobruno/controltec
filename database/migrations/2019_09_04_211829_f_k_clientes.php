<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FKClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) 
        {   
            $table->foreign('endereco_id')
            ->references('id')
            ->on('enderecos');

            $table->foreign('telefone_id')
            ->references('id')
            ->on('telefones');

            $table->foreign('pf_id')
            ->references('id')
            ->on('pessoa_fisica');

            $table->foreign('pj_id')
            ->references('id')
            ->on('pessoa_juridica');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
    }
}
