<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            "name" => "admin",
            "email" => "admin@gmail.com",
            'gender' => "male",
            'phone_number' => fake()->phoneNumber(),
            'address' => fake()->address(),
//            'date_of_birth' => ,
            "password" => Hash::make("aaaaaaaa"),
            "role" => "admin"
        ]);

        User::factory()->create([
            "name" => "staff",
            "email" => "staff@gmail.com",
            'gender' => "female",
            'phone_number' => fake()->phoneNumber(),
            'address' => fake()->address(),
            "password" => Hash::make("bbbbbbbb"),
            "role" => "staff"
        ]);
    }
}
