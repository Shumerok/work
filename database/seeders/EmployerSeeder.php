<?php

namespace Database\Seeders;

use App\Models\Employer;
use Database\Factories\EmployerFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Employer::factory(50)->create();
    }
}
