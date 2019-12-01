<?php

use Illuminate\Database\Seeder;
use App\os;

class OSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        //   \Bezhanov\Faker\ProviderCollectionHelper::addAllProvidersTo($faker);

        for ($i = 0; $i <= 50; $i++) {

            $os = os::create(['numero_os' => $faker->numerify('#############'),
            'data_execucao'=> $faker->date($format = 'Y-m-d', $max = 'now'),
            'descricao_servico'=> $faker->text,
            'data_vencimento'=> $faker->date($format = 'Y-m-d', $max = 'now'),
            'cliente_id'=> $faker->numberBetween($min = 1, $max = 31),
            'status_id'=> $faker->numberBetween($min = 1, $max = 4),
            'servico_id'=> $faker->numberBetween($min = 1, $max = 15),
            'tecnico_id'=> $faker->numberBetween($min = 1, $max = 20),
            'auxiliar_id'=> $faker->numberBetween($min = 1, $max = 20)
            ]);

            $os->equipamento()->attach($faker->numberBetween($min = 1, $max = 15));

        }
    }
}