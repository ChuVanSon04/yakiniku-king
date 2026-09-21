<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuCategory;
use App\Models\MenuItem;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        $beef = MenuCategory::where(
            'slug',
            'thit-bo'
        )->first();

        MenuItem::create([
            'category_id' => $beef->id,
            'name' => 'Wagyu',
            'slug' => 'wagyu',
            'description' => 'Thịt bò Wagyu',
            'price' => 299000,
            'is_must_try' => true,
            'is_for_kids' => false,
            'sort_order' => 1,
            'status' => true,
        ]);

        MenuItem::create([
            'category_id' => $beef->id,
            'name' => 'Beef Karubi',
            'slug' => 'beef-karubi',
            'description' => 'Thịt bò Karubi',
            'price' => 199000,
            'is_must_try' => true,
            'is_for_kids' => false,
            'sort_order' => 2,
            'status' => true,
        ]);
    }
}