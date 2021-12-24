<?php

namespace Database\Seeders;

use App\Models\Site;
use App\Models\Landing;
use App\Models\Campaign;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sites = Site::factory()
            ->count(3)
            ->create();

        $sites->each(function($site) {
            $landings = Landing::factory()
                ->count(rand(2,4))
                ->make();
            $site->landings()->saveMany($landings);

            $landings->each(function($landing) {

                $campaign = Campaign::factory()
                    ->make();
                $landing->campaigns()->save($campaign);
            });

        });
    }
}
