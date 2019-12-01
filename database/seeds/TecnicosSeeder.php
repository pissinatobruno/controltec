<?php

use Illuminate\Database\Seeder;
use App\tecnico;

class TecnicosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();
        
        for($i = 0; $i <= 20; $i++)
        {
            $tecnico = tecnico::create(['nome' => $faker->name, 
            'tp_registro' => $faker->boolean]);
        
        }
    }
}
