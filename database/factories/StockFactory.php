<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stock>
 */
class StockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'product_id' => Product::all()->random()->id,
            'quantity' => rand(300,500),
            'more' => fake()->text(),
//            "user_id" => 1,
//            "product_id" => rand(1,20),
//            "quantity" => rand(1,100),
        ];
    }
}
