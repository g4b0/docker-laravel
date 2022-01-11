<?php

namespace Tests\Feature;

use App\Models\Campaign;
use Tests\TestCase;
use App\Models\User;
use App\Models\LogbookRecord;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Config;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LeadControllerTest extends TestCase
{
    use WithFaker;
    //use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStore()
    {
        $user = User::where('email', Config::get('api.apiEmail'))->first();
        $token = JWTAuth::fromUser($user);
        $baseUrl = Config::get('app.url') . '/api/leads?token=' . $token;

        $campaign = Campaign::inRandomOrder()->first();
        $lead = LogbookRecord::factory()
                    ->make()
                    ->toArray();
        $lead['campaign_id'] = $campaign->id;
        $response = $this->json('POST', $baseUrl . '/', $lead);

        $response->assertStatus(200);
        $response->assertJson([
             "success" => "Lead succesfully inserted"
        ]);
    }

}
