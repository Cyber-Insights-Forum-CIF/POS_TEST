<?php

namespace Database\Seeders;

use App\Models\Photo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Photo::factory()->create([
            'url' => config('info.default_main_photo'),
            'name' => config('info.default_main_photo_name'),
            'ext' => config('info.ext'),
            'user_id' => 1,
        ]);

    }
}