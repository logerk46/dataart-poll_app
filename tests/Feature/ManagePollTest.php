<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tymon\JWTAuth\Exceptions\JWTException;

class ManagePollTest extends TestCase
{
    use WithFaker, RefreshDatabase;


    /** @test */
    public function guests_cannot_manage_polls()
    {
        $poll = factory('App\Poll')->create();

        $this->get('/api/polls')->assertStatus(500);
        $this->post('/api/polls/create')->assertStatus(500);
        $this->get('/api/polls/' . $poll->id)->assertStatus(500);
    }


//    /** @test */
//    public function a_user_can_create_poll()
//    {
//        $this->signIn();
//
//        //
//    }

//    /** @test */
//    public function a_user_can_view_a_their_polls()
//    {
//
//        $this->withoutExceptionHandling();
//
//        $user = factory('App\User')->create();
//
//        $this->signIn($user);
//
//        $poll = factory('App\Poll')->create(['user_id' => $user->id]);
//
//        $this->get("/api/polls/{$poll->id}")
//            ->assertSee($poll->title)
//            ->assertSee($poll->description);
//    }
}
