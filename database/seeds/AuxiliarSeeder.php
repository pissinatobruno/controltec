<?php

use Illuminate\Database\Seeder;
use App\auxiliar;

class AuxiliarSeeder extends Seeder
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
            $aux = auxiliar::create(['nome' => $faker->name]);
        
        }
    }
}
