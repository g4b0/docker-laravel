<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LandingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->lexify('lnd-?????????'),
            'path' => $this->faker->slug(rand(1,4)),
        ];
    }

}
