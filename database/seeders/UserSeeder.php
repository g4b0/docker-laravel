<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;

class UserSeeder extends Seeder
{
    /**
     * Create a user for the test suite
     *
     * @return void
     */
    public function run()
    {
        $email = Config::get('api.apiEmail');
        $password = Config::get('api.apiPassword');

        $user = new User;
        $user->name = 'Test Suite';
        $user->email = $email;
        $user->email_verified_at = now();
        $user->password = Hash::make($password);
        $user->remember_token = Str::random(10);
        
        $user->save();
    }

}
