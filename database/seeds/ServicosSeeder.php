<?php

use Illuminate\Database\Seeder;
use App\servico;

class ServicosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();
        
        for($i = 0; $i <= 15; $i++)
        {
            $servico = servico::create(['descricao' => $faker->company, 
            'valor_clt' => $faker->numerify('##.##'), 
            'valor_terc' => $faker->numerify('##.##')]);
        
        }
    }
}
