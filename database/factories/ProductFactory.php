<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory; // Import Faker\Factory

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = FakerFactory::create(); // Create a Faker instance
        $faker->addProvider(new \Bluemmb\Faker\PicsumPhotosProvider($faker)); // Add PicsumPhotosProvider

        return [
            'naam' => $faker->word(),
            'omschrijving' => $faker->sentence(),
            'prijs' => $faker->randomFloat(2, 5, 500), // Random price between 5 and 500
            'afbeelding' => $faker->imageUrl(640, 480), // Random product image
        ];
    }
}