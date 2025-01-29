<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Organizations\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Carrier>
 */
class CarrierFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $suffixes = ['Trucking', 'Transport', 'Carriers', 'Logistics', 'Freight'];
        $prefixes = ['Interstate', 'Regional', 'Express', 'American', 'National', 'Pacific', 'Elite'];
        
        return [
            'name' => fake()->randomElement($prefixes) . ' ' . fake()->company() . ' ' . fake()->randomElement($suffixes),
        ];
    }
}

