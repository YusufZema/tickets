<?php

namespace Database\Factories;

use App\Models\Ticker;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends Factory<Ticker>
 */
class TickerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            "user_id" => User::factory(),
            "title" => fake()->words(3, true),
            "description" => fake()->paragraph(),
            "status" => fake()->randomElement( "A" , "C" , "H" , " X " ),

        ];
    }
}
