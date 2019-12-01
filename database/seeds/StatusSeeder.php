<?php

use Illuminate\Database\Seeder;
use App\status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $status = status::create(['descricao' => 'Iniciada', 'tipoStatus' => 'Iniciada']);
            $status->create(['descricao' => 'Agendada','tipoStatus' => 'Agendada']);
            $status->create(['descricao' => 'Em Execução','tipoStatus' => 'Em Execução']);
            $status->create(['descricao' => 'Cancelada', 'tipoStatus' => 'Cancelada']);
            $status->create(['descricao' => 'Finalizada','tipoStatus' => 'Finalizada']);
    }
}
