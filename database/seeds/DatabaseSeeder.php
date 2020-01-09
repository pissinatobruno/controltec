<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $Administrador = Role::create(['name' => 'Administrador']);
        $Utilizador = Role::create(['name' => 'Utilizador']);
        Permission::create(['name' => 'AcessarClientes']);
        Permission::create(['name' => 'AcessarOS']);
        Permission::create(['name' => 'AcessarFuncionarios']);
        Permission::create(['name' => 'AcessarServicos']);
        Permission::create(['name' => 'AcessarAgendamentos']);
        Permission::create(['name' => 'AcessarEquipamentos']);
        Permission::create(['name' => 'AcessarMetas']);
        Permission::create(['name' => 'AcessarStatus']);
        Permission::create(['name' => 'AcessarUsuarios']);
        

        $PermUtilizador =  Permission::whereIn("id",["1", "2", "5"])->get();
        $PermAdmin = Permission::whereIn("id",["1","2","3","4","5","6","7","8","9"])->get();

        $Administrador->givePermissionTo($PermAdmin);
        $Utilizador->givePermissionTo($PermUtilizador);

     
        
        DB::table('users')->insert([
            'name' => 'Bruno Pissinato',
            'email' => 'bruno@bruno.com',
            'password' => bcrypt('12345678'),
            'admin' => true,
        ]);
        
        User::find(1)->assignRole('Administrador');

        DB::table('users')->insert([
            'name' => 'Teste Utilizador',
            'email' => 'teste@teste.com',
            'password' => bcrypt('12345678'),
            'admin' => false,
        ]);
        
        User::find(2)->assignRole('Utilizador');

        $this->call('ClienteSeeder');
        $this->call('AuxiliarSeeder');
        $this->call('EquipamentoSeeder');
        $this->call('ServicosSeeder');
         $this->call('StatusSeeder');
        $this->call('TecnicosSeeder');
        $this->call('OSSeeder');


    }
}
