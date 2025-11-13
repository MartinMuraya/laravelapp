<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service> */
class ServiceFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(14),
            'price' => $this->faker->randomFloat(2, 1000, 30000), // KSh range
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
