<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Config;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationJwtTest extends TestCase
{
    /**
     * Login as default API user and get token back.
     *
     * @return void
     */
    public function testLogin()
    {
        $baseUrl = Config::get('app.url') . '/api/login';
        $email = Config::get('api.apiEmail');
        $password = Config::get('api.apiPassword');

        $response = $this->json('POST', $baseUrl . '/', [
            'email' => $email,
            'password' => $password
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'access_token', 'token_type', 'expires_in'
            ]);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function testLogout()
    {
        $user = User::where('email', Config::get('api.apiEmail'))->first();
        $token = JWTAuth::fromUser($user);
        $baseUrl = Config::get('app.url') . '/api/logout?token=' . $token;

        $response = $this->json('POST', $baseUrl, []);

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'message' => 'User successfully logged out.'
            ]);
    }

    /**
     * Test token refresh.
     *
     * @return void
     */
    public function testRefresh()
    {
        $user = User::where('email', Config::get('api.apiEmail'))->first();
        $token = JWTAuth::fromUser($user);
        $baseUrl = Config::get('app.url') . '/api/refresh?token=' . $token;

        $response = $this->json('POST', $baseUrl, []);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'access_token', 'token_type', 'expires_in'
            ]);
    }
}
