<?php

use App\Models\Combo;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('combo list shows a popup with included dishes and their prices', function () {
    $category = MenuCategory::create([
        'name' => 'Món chính',
        'slug' => 'mon-chinh',
    ]);
    $menuItem = MenuItem::create([
        'category_id' => $category->id,
        'name' => 'Ba chỉ bò Mỹ',
        'slug' => 'ba-chi-bo-my',
        'description' => 'Thịt bò nướng mềm',
        'price' => 120000,
    ]);
    $combo = Combo::create([
        'name' => 'Combo gia đình',
        'slug' => 'combo-gia-dinh',
        'image' => 'menu/combos/family.jpg',
        'price' => 199000,
    ]);
    $combo->menuItems()->attach($menuItem, ['quantity' => 2]);

    $this->get(route('menu.combos'))
        ->assertOk()
        ->assertSee('data-bs-toggle="modal"', false)
        ->assertSee('id="combo-detail-'.$combo->id.'"', false)
        ->assertSee('/storage/menu/combos/family.jpg', false)
        ->assertSee('Combo gia đình')
        ->assertSee('Ba chỉ bò Mỹ')
        ->assertSee('Thịt bò nướng mềm')
        ->assertSee('120.000 đ')
        ->assertSee('240.000 đ')
        ->assertSee('199.000 đ')
        ->assertSee('Tổng giá lẻ');
});

test('combo list does not show inactive combos', function () {
    $combo = Combo::create([
        'name' => 'Combo đã ẩn',
        'slug' => 'combo-da-an',
        'price' => 199000,
        'status' => false,
    ]);

    $this->get(route('menu.combos'))
        ->assertOk()
        ->assertDontSee('Combo đã ẩn');
});
