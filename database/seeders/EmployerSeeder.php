<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Seeder;

class EmployerSeeder extends Seeder
{
    public function run()
    {
//        echo memory_get_peak_usage();
        $data = $this->idGenerate(1, 40000);
        foreach ($this->roots(10000) as $root) {
            Employer::insert($root);
        }
        foreach ($this->children(40000, $data) as $child) {
            Employer::insert($child);
        }
//        echo "\n";
//        echo memory_get_peak_usage();
//        $this->children(4000, 1000, $data);
        Employer::fixTree();
    }

    private function idGenerate(int $from, int $to): array
    {
        $data = [];
        for ($i = $from; $i <= $to; $i++) {
            $data[] = $i;
        }

        return $data;
    }

    private function phoneGenerator(): string
    {
        $mobileCode = [50, 66, 95, 99, 67, 68, 96, 97, 98, 63, 73, 93];
        $code = '+380';
        $code .= ' ('.fake()->randomElement($mobileCode).') ';
        $code .= rand(100, 999);
        $code .= ' '.rand(10, 99);
        $code .= ' '.rand(10, 99);
        return $code;
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

    private function children(int $amount, array $idArray)
    {
        for ($i = 0; $i < $amount; $i++) {
            yield [
                'photo' => 'avatars/3551739.png',
                'name' => fake()->firstName.' '.fake()->lastName,
                'position_id' => fake()->randomElement(Position::all()->pluck('id')),
                'date_employment' => now()->format('Y-m-d'),
                'phone' => $this->phoneGenerator(),
                'email' => fake()->unique()->email(),
                'salary' => fake()->randomFloat(3, 1, 500),
                'created_at' => now(),
                'updated_at' => now(),
                'admin_created_id' => fake()->randomElement(User::all()->pluck('id')),
                'admin_updated_id' => fake()->randomElement(User::all()->pluck('id')),
//                'parent_id' => ++$i,
                'parent_id' => array_shift($idArray),
            ];
        }
    }

    private function insertByChunk(array $data, $chunk)
    {
        $chunks = array_chunk($data, $chunk);
        foreach ($chunks as $chunk) {
            Employer::insert($chunk);
        }
    }

    public function seedByRelations()
    {
        // TODO very slow seed. Need improvement.

        Employer::factory(50)
            ->create()
            ->each(function ($employee) {
                $employee->children()->saveMany(Employer::factory(1)->make())
                    ->each(callback: function ($employee) {
                        $employee->children()->saveMany(Employer::factory(1)->make())
                            ->each(callback: function ($employee) {
                                $employee->children()->saveMany(Employer::factory(1)->make())
                                    ->each(callback: function ($employee) {
                                        $employee->children()->saveMany(Employer::factory(1)->make());
                                    });
                            });
                    });
            });
    }

    public function getEmployerFakeModel(int $items)
    {
        // TODO another draft of seed.Slow.

        for ($i = 0; $i < $items; $i++) {
            yield Employer::factory($items)->make(
                [
                    'children' => [
                        (Employer::factory(1)->make([
                                'children' => [
                                    Employer::factory(1)->make([
                                        'children' => [
                                            Employer::factory(1)->make([
                                                'children' => [
                                                    Employer::factory(1)->make()[0]->toArray()
                                                ]
                                            ])[0]->toArray()
                                        ]
                                    ])[0]->toArray()
                                ]
                            ]
                        ))[0]->toArray()
                    ]
                ]
            )[0];
        }
    }
}
