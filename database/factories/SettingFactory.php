<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'shop_name' => 'Your Shop Name',
            'phone' => '+959XXXXXXXXX, +959XXXXXXXXX, +959XXXXXXXXX',
            'email' => 'name@example.com, info@example.com',
            'address' => 'No.001, Example Road, Yangon, Myanmar',
            'tax' => 5,
        ];
    }
}
