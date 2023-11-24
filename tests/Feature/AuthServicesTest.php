<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;

class AuthServicesTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * Test a success token generation during the login process
     */
    public function test_success_login(): void
    {
        $user = User::factory()->assignRole("Agent")->create();
        $response = $this->post('api/auth', [
            'username' => $user->username,
            'password' => 'secret',
        ]);
        $response->assertStatus(200);
        $this->assertAuthenticated();
    }

    /**
     * Test a login request with wrong credentials
     */
    public function test_wrong_credentials_login_request(): void
    {
        $user = User::factory()->assignRole("Agent")->create();
        $username = 'thisisatest';
        $response = $this->post('api/auth', [
            'username' => "thisisatest",
            'password' => 'secret',
        ]);
        $response->assertStatus(401);
        $response->assertJson([
            "meta" => [
                "success" => false,
                "errors" => ["The credentials for: {$username} are incorrect"]
            ],
            "data"=> []
        ]);
    }
}
