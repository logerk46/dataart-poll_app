<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function a_user_can_register()
    {
        $response = $this->post('api/register', [
            'name' => 'Test User',
            'email' => 'test123@gmail.com',
            'password' => 'test1234'
        ]);

        $response->assertJsonStructure([
            'success',
            'token',
        ]);
    }

    /** @test */
    public function a_user_can_login()
    {
        User::create([
            'name' => 'test test',
            'email' => 'test@gmail.com',
            'password' => bcrypt('123456')
        ]);

        $response = $this->post('api/login', [
            'email' => 'test@gmail.com',
            'password' => '123456'
        ]);

        $response->assertJsonStructure([
            'success',
            'token',
        ]);
    }
}
