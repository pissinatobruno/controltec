<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->increments('id', 15);
            $table->date('data_agendamento', 15);
            $table->string('periodo', 50);
            $table->unsignedInteger('os_id');
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('agendamentos');
    }
}
