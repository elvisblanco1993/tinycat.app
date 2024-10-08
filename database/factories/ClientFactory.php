<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'team_id' => Team::factory(), // Create a new team using a Team factory or provide a specific ID
            'owner_id' => User::factory()->create(['is_client' => true]), // Create a new user using a User factory or provide a specific ID
            'name' => $this->faker->company,
            'dba' => $this->faker->companySuffix,
            'business_type' => $this->faker->randomElement(['limited_liability_company', 'corporation', 'sole_proprietorship', 'single_member_llc']),
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'itin' => $this->faker->regexify('[0-9]{9}'),
            'address' => $this->faker->streetAddress,
            'address_ext' => $this->faker->secondaryAddress,
            'city' => $this->faker->city,
            'state' => $this->faker->stateAbbr,
            'zip' => $this->faker->postcode,
            'country' => $this->faker->country,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
