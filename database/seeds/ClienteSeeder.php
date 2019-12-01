<?php

use Illuminate\Database\Seeder;
use App\cliente;

class ClienteSeeder extends Seeder
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

    for($i = 0; $i <= 50; $i++)
    {
            
            $cliente = cliente::create(['nome' => $faker->name, 'num_conta' => $faker->numerify('###########')]);
    

            $cliente->pessoa_fisica()->create([
                'documento' => $faker->numerify('###########')
            ]);

            $cliente->telefones()->create([
                'telefone' => $faker->numerify('###########'),
                'telefone2' => $faker->numerify('###########')
            ]);

            $cliente->enderecos()->create([
                'cep' => $faker->numerify('########'),
                'logradouro' => $faker->address,
                'numero'=> $faker->numerify('##'),
                'bairro'=>$faker->cityPrefix,
                'tp_residencia' => 'casa',
                'cidade'=> $faker->city,
                'estado'=> $faker->lexify('??')
            ]);
        }
    }
}
