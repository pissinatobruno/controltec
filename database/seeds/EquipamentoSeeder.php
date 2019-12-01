<?php

use Illuminate\Database\Seeder;
use App\equipamento;

class EquipamentoSeeder extends Seeder
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
                
                $equip = equipamento::create(['descricao' => $faker->jobTitle]);
            
        }
    }
}
