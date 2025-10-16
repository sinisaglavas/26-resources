<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shipment>
 */
class ShipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3), // npr. "Express delivery package"
            'from_city' => $this->faker->city(),
            'from_country' => $this->faker->country(),
            'to_city' => $this->faker->city(),
            'to_country' => $this->faker->country(),
            'price' => $this->faker->randomFloat(2, 10, 500), // npr. 145.75
            'status' => $this->faker->randomElement(['pending', 'in_transit', 'delivered', 'cancelled']),
            'user_id' => User::factory(), // povezuje shipment sa nekim korisnikom
            'details' => $this->faker->paragraph(2), // dodatne informacije
        ];
    }
}
