<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * @test
     * @return void
     */
    public function missingData()
    {
        $response = $this->post('/api/login', [], [
            'Accept' => 'application/json'
        ]);
        $response->assertStatus(422);
    }

    /**
     * @test
     * @return void
     */
    public function wrongByEmail()
    {
        $user = factory(User::class)->create();
        $response = $this->post('/api/login', [
            'email' => 'test'.$user->email,
            'password' => 'password',
            'device' => 'w'
        ], [
            'Accept' => 'application/json'
        ]);
        $response->assertStatus(422);
    }

    /**
     * @test
     * @return void
     */
    public function wrongByPassword()
    {
        $response = $this->post('/api/login', [
            'email' => 'test@test.test',
            'password' => 'password2',
            'device' => 'w'
        ], [
            'Accept' => 'application/json'
        ]);
        $response->assertStatus(422);
    }

    /**
     * @test
     * @return void
     */
    public function success()
    {
        $user = factory(User::class)->create();
        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
            'device' => 'w'
        ], [
            'Accept' => 'application/json'
        ]);
        $response->assertStatus(200);
        $this->assertTrue(true);
        $this->assertArrayHasKey('success', 'message');
    }

}
