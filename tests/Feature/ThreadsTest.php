<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function an_user_can_view_all_threads()
    {
        $thread = factory('App\Thread')->create();

        $this->get('/threads')
            ->assertSee($thread->title);
    }

    /** @test */
    public function an_user_can_view_a_single_thread()
    {
        $thread = factory('App\Thread')->create();

        $this->get('/threads/'. $thread->id)
            ->assertSee($thread->title);
    }
}
