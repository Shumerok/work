<?php

namespace Database\Factories;

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
            'photo'=>$this->faker->imageUrl(300,300),
            'name'=>$this->faker->name,
            'position_id'=>null,
            'date_employment' => date('d.m.Y'),
            'phone'=>$this->faker->regexify("^(\+380\ ((93)) [0-9]{3} [0-9]{2} [0-9]{2}$"),
            'email'=>$this->faker->unique()->email,
            'salary'=>$this->faker->randomFloat(2,0, 500)
        ];
    }
}
