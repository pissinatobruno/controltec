<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'name' => 'Bruno Pissinato',
            'email' => 'bruno@bruno.com',
            'password' => bcrypt('1234'),
            'admin' => true,
        ]);

        factory(App\User::class, 50)->create();

    }
}
