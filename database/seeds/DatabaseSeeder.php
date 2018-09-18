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
        factory('App\Thread', 30)->create();
        factory('App\User')->create([
            'name' => 'John Doe',
            'email' => 'johndoe@gmail.com',
            'password' => bcrypt('123456'),
            'confirmed' => 1
        ]);
        // $this->call(UsersTableSeeder::class);
    }
}
