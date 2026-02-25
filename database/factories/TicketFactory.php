<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fiscal_name' => fake()->name(),
            'nif' => fake()->unique()->numberBetween(1, 100),
            'tax_amount' => fake()->numberBetween(1, 100),
            'total_before_tax' => fake()->numberBetween(1, 100),
            'total_tax' => fake()->numberBetween(1, 100),
            'total_after_tax' => fake()->numberBetween(1, 100),
            'datetime' => fake()->dateTime(),
            'ticket_number' => fake()->numberBetween(1, 100),
        ];
    }
}
