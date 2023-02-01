<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Position>
 */
class PositionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=> $this->faker->unique()->randomElement(['Frontend dev', 'Backend dev', 'Lead designer', 'Team Lead', 'Tech Lead', 'CEO']),
            'admin_created_id' => fake()->randomElement(User::all()->pluck('id')),
            'admin_updated_id' => fake()->randomElement(User::all()->pluck('id')),
        ];
    }
}
