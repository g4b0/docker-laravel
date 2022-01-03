<?php

namespace Database\Seeders;

use App\Models\Logbook;
use App\Models\Campaign;
use Illuminate\Database\Seeder;

class LogbookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $campaigns = Campaign::all();
        $campaigns->each(function($campaign) {
            $logbooks = Logbook::factory()
                ->count(rand(5,15))
                ->make();
            $campaign->logbooks()->saveMany($logbooks);
        });
    }
}
