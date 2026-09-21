<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Restaurant;

class RestaurantSeeder extends Seeder
{
    public function run(): void
    {
        Restaurant::create([
            'name' => 'Yakiniku King - Hà Nội',
            'address' => 'Hà Nội',
            'phone' => '0900000000',
            'latitude' => 21.028511,
            'longitude' => 105.804817,
            'status' => true,
        ]);
    }
}