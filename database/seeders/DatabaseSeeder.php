<?php

namespace Database\Seeders;

// use App\Models\User;
// use App\Models\Customer;
// use App\Models\Ticket;
use App\Models\MySQL\Language;
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
        Language::factory(10)->create();


        // User::factory()->create([
        //     'name' => 'Mark',
        //     'email' => 'a@a.a',
        //     'password' => 'password'
        // ]);
    }
}
