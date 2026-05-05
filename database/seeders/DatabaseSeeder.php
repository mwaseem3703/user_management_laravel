<?php

namespace Database\Seeders;

use App\Models\UserRegistration;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Generate 10 dummy user records
        UserRegistration::factory(10)->create();
    }
}