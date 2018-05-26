<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function testBasicTest()
    {
        $response = $this->get('/threads');

        $this->assertTrue(true);
    }
}
