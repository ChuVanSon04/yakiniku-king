<?php

use App\Models\MenuCategory;
use App\Models\MenuItem;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('our menu displays each category image and its items in category order', function () {
    $mainDishes = MenuCategory::create([
        'name' => 'Món chính',
        'slug' => 'mon-chinh',
        'image' => 'menu/categories/main-dishes.jpg',
        'sort_order' => 2,
    ]);
    $starters = MenuCategory::create([
        'name' => 'Khai vị',
        'slug' => 'khai-vi',
        'image' => 'menu/categories/starters.jpg',
        'sort_order' => 1,
    ]);

    MenuItem::create([
        'category_id' => $mainDishes->id,
        'name' => 'Thịt bò nướng',
        'slug' => 'thit-bo-nuong',
        'price' => 250000,
    ]);
    MenuItem::create([
        'category_id' => $starters->id,
        'name' => 'Salad rong biển',
        'slug' => 'salad-rong-bien',
        'price' => 85000,
    ]);

    $this->get(route('menu.index'))
        ->assertOk()
        ->assertSeeInOrder([
            'Khai vị',
            'src="'.asset('storage/'.$starters->image).'"',
            'Salad rong biển',
            'Món chính',
            'src="'.asset('storage/'.$mainDishes->image).'"',
            'Thịt bò nướng',
        ], false)
        ->assertSee('menu-category-layout-reversed', false);
});
