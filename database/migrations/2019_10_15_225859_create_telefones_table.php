<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTelefonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telefones', function (Blueprint $table) {
            $table->increments('id', 15);
            $table->char('telefone', 15);
            $table->char('telefone2', 15)->nullable();
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
        Schema::dropIfExists('telefones');
    }
}
