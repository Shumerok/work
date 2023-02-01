<?php

namespace Database\Factories;

use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employer>
 */
class EmployerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'photo' => '/avatars/3551739.jpg',
            'name' => $this->faker->firstName.' '.$this->faker->lastName,
            'position_id' => fake()->randomElement(Position::all()->pluck('id')),
            'date_employment' => now()->format('Y-m-d'),
            'phone' => $this->phoneGenerator(),
            'email' => $this->faker->unique()->email,
            'salary' => $this->faker->randomFloat(null, 1, 500),
            'admin_created_id' => fake()->randomElement(User::all()->pluck('id')),
            'admin_updated_id' => fake()->randomElement(User::all()->pluck('id')),
        ];
    }
}
