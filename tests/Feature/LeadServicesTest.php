<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class LeadServicesTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * Test the request to get all the leads records
     */
    public function test_get_all_leads(): void
    {
        $user = User::factory()->assignRole("Manager")->create();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeaders([
            'Authorization' => "Bearer {$token}",
        ])->get('api/leads');
        $response->assertStatus(200);
    }

    /**
     * Test the request to get the detail of a non created lead
     */
    public function test_get_the_wrong_lead_detail(): void
    {
        $user = User::factory()->assignRole("Manager")->create();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeaders([
            'Authorization' => "Bearer {$token}",
        ])->get("api/leads/1000");
        $response->assertStatus(200);
        $response->assertJson([
            "meta" => [
                "success" => true,
                "errors" => []
            ],
            "data"=> null
        ]);
    }

    /**
     * Test the request to create a lead
     */
    public function test_lead_creation(): void
    {
        $user = User::factory()->assignRole("Manager")->create();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeaders([
            'Authorization' => "Bearer {$token}",
        ])->post("api/leads", [
            "name" => "Mi candidato",
            "source" => "Fotocasa",
            "owner" =>  $user->id
        ]);
        $response->assertStatus(200);
    }

    /**
     * Test the request to create a lead
     */
    public function test_lead_creation_with_the_wrong_role(): void
    {
        $user = User::factory()->assignRole("Agent")->create();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeaders([
            'Authorization' => "Bearer {$token}",
        ])->post("api/leads", [
            "name" => "Mi candidato",
            "source" => "Fotocasa",
            "owner" =>  $user->id
        ]);
        $response->assertStatus(403);
    }
}
