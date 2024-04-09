<?php

namespace Database\Factories;

use App\Enums\Gender;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
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
            'gender' => $gender = fake()->randomElement(Gender::values()),
            'age' => fake()->numberBetween(20, 100),
            'name' => [
                'title' => fake()->title($gender),
                'first' => fake()->firstName($gender),
                'last'  => fake()->lastName($gender),
            ],
            'location' => [
                'street' => [
                    'number' => fake()->numberBetween(1000, 9999),
                    'name' => fake()->streetName
                ],
                'city' => fake()->city,
                'state' => fake()->countryCode,
                'country' => fake()->country,
                'postcode' => fake()->postcode,
                'coordinates' => [
                    'latitude' => (string) fake()->latitude,
                    'longitude' => (string) fake()->longitude,
                ],
                'timezone' => [
                    'offset' => '+7:00',
                    'description' => fake()->streetAddress
                ]
            ]
        ];
    }
}
