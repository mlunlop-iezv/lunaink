<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tattoo>
 */
class TattooFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
public function definition()
{
    return [
        'title' => fake()->sentence(3),
        'duration' => fake()->numberBetween(2, 8) . ' hours',
        'image_url' => 'https://placehold.co/600x600/111/fff?text=Tattoo', 
        
        'artist_id' => \App\Models\Artist::factory(),
        'style_id' => \App\Models\Style::factory(),
    ];
}
}
