<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Campaign;
use App\Models\LeadEmail;
use App\Models\LogbookRecord;
use App\Jobs\DeduplicationByEmail;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Config;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LeadControllerTest extends TestCase
{
    use WithFaker;
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStore()
    {
        Queue::fake();

        // Authentication
        $user = User::where('email', Config::get('api.apiEmail'))->first();
        $token = JWTAuth::fromUser($user);
        $baseUrl = Config::get('app.url') . '/api/leads?token=' . $token;

        // Mocking data
        $campaign = Campaign::inRandomOrder()->first();
        $lead = LogbookRecord::factory()
                    ->make()
                    ->toArray();
        $lead['campaign_id'] = $campaign->id;

        // Doing the request
        $response = $this->json('POST', $baseUrl . '/', $lead);

        // Check succesful response
        $response->assertStatus(200);
        $response->assertJson([
             "success" => "Lead succesfully inserted"
        ]);

        // Search for the inserted lead
        $logbookRecord = LogbookRecord::orderBy('id', 'desc')->first();
        $this->assertEquals($lead['email'], $logbookRecord->email);

        // Assert a DeduplicationByEmail job was pushed to the queue
        Queue::assertPushed(DeduplicationByEmail::class);
    }

}
