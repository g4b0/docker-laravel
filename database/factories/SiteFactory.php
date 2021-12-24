<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fqdn = $this->faker->domainName();
        return [
            'name' => $fqdn,
            'url' => 'https://www.' . $fqdn,
        ];
    }
}
