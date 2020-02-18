<?php

namespace Tests;

use Schema;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        Schema::enableForeignKeyConstraints();

        $this->withoutExceptionHandling();
    }

    protected function signIn($user = null)
    {
        return $this->actingAs($user ?: create('App\User'));
    }
}
