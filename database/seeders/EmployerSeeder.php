<?php

namespace Database\Seeders;

use App\Models\Employer;
use Illuminate\Database\Seeder;

class EmployerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employer::factory(10)
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
}
