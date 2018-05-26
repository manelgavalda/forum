<?php

namespace Tests\Unit;

use Tests\TestCase;

class ThreadsTest extends TestCase
{
    /** @test */
    public function testBasicTest()
    {
        $response = $this->get('/threads');

        $this->assertTrue(true);
    }
}
