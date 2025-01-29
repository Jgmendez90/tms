<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Organizations\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shipper>
 */
class ShipperFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $suffixes = ['Manufacturing', 'Industries', 'Products', 'Supply Co.', 'Production'];
        $prefixes = ['Global', 'United', 'Premier', 'Advanced', 'Industrial', 'Standard', 'Quality'];
        
        return [
            'name' => fake()->randomElement($prefixes) . ' ' . 
                     fake()->company() . ' ' . 
                     fake()->randomElement($suffixes),
        ];
    }
}

