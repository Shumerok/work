<?php

namespace Tests\Unit;

use App\Models\Position;
use App\Models\User;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_that_true_is_true()
    {
        $before =  memory_get_peak_usage();
        $data = [];
       foreach ($this->roots(50000) as $root){
           $data[] = $root;
       }
        $after =  memory_get_peak_usage();
        echo ($after-$before)/1000000;
        $this->assertEquals(50000,count($data));
    }


    private function roots(int $amount)
    {
        for ($i = 0; $i < $amount; $i++) {
            yield [
                'photo' => 'avatars/3551739.png',
                'name' => fake()->firstName.' '.fake()->lastName,
                'position_id' => fake()->randomElement(Position::all()->pluck('id')),
                'date_employment' => now()->format('Y-m-d'),
                'phone' => $this->phoneGenerator(),
                'email' => fake()->unique()->email,
                'salary' => fake()->randomFloat(3, 1, 500),
                'created_at' => now(),
                'updated_at' => now(),
                'admin_created_id' => fake()->randomElement(User::all()->pluck('id')),
                'admin_updated_id' => fake()->randomElement(User::all()->pluck('id')),
            ];
        }
    }

    private function phoneGenerator(): string
    {
        $mobileCode = [50,66,95,99,67,68,96,97,98,63,73,93];
        $code = '+380';
        $code .= ' ('. fake()->randomElement($mobileCode) . ') ';
        $code .= rand(100, 999);
        $code .= ' '.rand(10, 99);
        $code .= ' '.rand(10, 99);
        return $code;
    }
}
