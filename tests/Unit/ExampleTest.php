<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_has_poll()
    {
        $user = factory('App\User')->create();

        $this->assertInstanceOf(Collection::class, $user->polls);
    }
}
