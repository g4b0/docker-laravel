<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LogbookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),    
            'email' => $this->faker->email(),
            'telephone' => $this->faker->e164PhoneNumber(),
            'privacy' => 1,
            'privacy_marketing' => rand(0,1),
            'privacy_third_party' => rand(0,1),
        ];
    }
}
