<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
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
        return [
            'category_id' => Category::factory(),
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'buy_price' => $this->faker->randomFloat(2, 100, 1000),
            'discount_price' => $this->faker->randomFloat(2, 10, 99),
            'available_amount' => $this->faker->numberBetween(1, 100),
            'is_visible' => true,
        ];
    }
}
