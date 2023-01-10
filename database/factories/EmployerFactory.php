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
            'photo' => $this->faker->imageUrl(300, 300),
            'name' => $this->faker->name,
            'position_id' => fake()->randomElement(Position::all()->pluck('id')),
            'date_employment' => date('Y-m-d'),
            'phone'=>$this->phoneGenerator(),
            'email' => $this->faker->unique()->email,
            'salary' => $this->faker->randomFloat(null, 1, 500),
            'admin_created_id'=>fake()->randomElement(User::all()->pluck('id')),
            'admin_updated_id'=>fake()->randomElement(User::all()->pluck('id')),
        ];
    }

    private function phoneGenerator()
    {
        $code = '+380';
        $code .= ' (93) ';
        $code .= rand(100,999);
        $code .= ' '.  rand(10,99);
        $code .= ' '.  rand(10,99);
        return $code;
    }
}
