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
        $channels = factory('App\Channel', 5)->create();

        $channels->each(function($channel) {
            $threads = factory('App\Thread', rand(1, 5))->create(['channel_id' => $channel->id]);

            $threads->each(function($thread) {
                factory('App\Reply', rand(0, 8))->create(['thread_id' => $thread->id]);
            });
        });

        factory('App\User')->create([
            'name' => 'John Doe',
            'email' => 'johndoe@gmail.com',
            'password' => bcrypt('123456'),
            'confirmed' => 1
        ]);
        // $this->call(UsersTableSeeder::class);
    }
}
