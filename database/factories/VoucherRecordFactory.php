<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Voucher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VoucherRecord>
 */
class VoucherRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $products_id = Product::all()->random()->id;
        $cost = Product::findOrFail($products_id)->sale_price;
        $quantity =  rand(10, 20);
        return [
//            'voucher_id' => Voucher::all()->random()->id,
//            'product_id' => $products_id,
//            'products_id' => Product::all()->random()->id,
//            'quantity' => $quantity,
//            'cost' => ($cost * $quantity)
            "voucher_id" => rand(1, 5),
            "product_id" => rand(1, 20),
            "quantity" => rand(1, 100),
            'cost' => rand(1, 100)
        ];
    }
}
