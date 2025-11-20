<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
Use App\Models\User;

class AutControllerTest extends TestCase
{
    // /**
    //  * A basic feature test example.
    //  */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
    use RefreshDatabase;
    #[Test]
    public function user_can_register()
    {
        $payload = [
            'name' => 'Patrik',
            'email' => 'patrik@gmail.com',
            'password' => 'Nemtudom20',
            'password_confirmation' => 'Nemtudom20'
        ];

        $response = $this->postJson('/api/register', $payload);

        $response->assertStatus(201)->assertJsonStructure(['message','user']);
        $this->assertDatabaseHas('users', [
            'email' => 'patrik@gmail.com']);
    }
    #[Test]
    public function user_can_login()
    {
        //Arrange
        $user = User::factory()->create(
            [
                'email' => 'tesztelek@gmail.com',
                'password' => bcrypt('Jelszo123'),
            ]);
            $credentials=
            [
                'email' => 'tesztelek@gmail.com',
                'password' => 'Jelszo123',
            ];
            $response = $this->postJson('/api/login', $credentials);
            $response->assertStatus(200)->assertJsonStructure(['access_token','token_type']);
    }
    // #[Test]
    // public function user_can_logout()
    // {

    // }
}
