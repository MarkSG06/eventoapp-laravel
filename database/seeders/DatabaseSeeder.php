<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@a.a',
            'password' => 'password'
        ]);

				Customer::factory()->create([
            'name' => 'Customer',
            'email' => 'customer@a.a',
            'password' => 'password'
        ]);
    }
}
