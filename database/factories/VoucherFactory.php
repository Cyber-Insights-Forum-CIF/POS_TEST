<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Voucher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Voucher>
 */
class VoucherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
//        return [
//            'voucher' => Voucher::all()->random(),
//            'phone' => fake()->phoneNumber(),
//            'voucher_number' => fake()->randomNumber(),
//            'total' => 400,
//            'tax' => 5,
//            'net_total' => 5,
//            'user_id' => 1,
//        ];
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 6; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return [
            'voucher' => $randomString,
            'phone' => fake()->phoneNumber(),
            "voucher_number" => $randomString,
            'total' => 400,
            'tax' => 5,
            'net_total' => 5,
            "user_id" => 1
        ];

    }
}
