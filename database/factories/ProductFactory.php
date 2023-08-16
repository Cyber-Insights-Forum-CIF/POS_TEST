<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $unit = ['mol','kg','cd'];
        $randNumber = rand(0,2);
        $current = $unit[$randNumber];
        return [
//            "name" => fake()->name(),
//            "brand_id" => rand(1,5),
//            "user_id" => 1,
//            "actual_price" => 400,
//            "sale_price" => 500,
//            "total_stock" => 0,
//            "unit" => 1,
            'name' => fake()->name,
            'user_id' => 1,
            'brand_id' => Brand::all()->random()->id,
            'actual_price' => rand(200, 1000),
            'sales_price' => rand(200, 1000),
            'total_stock' => rand(5, 30),
            'unit' =>$current,
            'more_information' => fake()->text(),
//            'user_id' => User::all()->random()->id,
            'photos' => config('info.default_main_photo')
        ];
    }
}
