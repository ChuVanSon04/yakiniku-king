<?php

use App\Models\KidsItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('stores kids items without requiring a menu category', function () {
    $this->actingAs(User::factory()->create())
        ->post(route('admin.kids-items.store'), [
            'name' => 'Bộ dụng cụ ăn cho bé',
            'type' => 'supply',
            'description' => 'Bộ đồ dùng dành riêng cho trẻ nhỏ.',
            'price' => null,
            'sort_order' => 1,
            'status' => '1',
        ])
        ->assertRedirect(route('admin.kids-items.index'));

    $this->assertDatabaseHas('kids_items', [
        'name' => 'Bộ dụng cụ ăn cho bé',
        'type' => 'supply',
        'price' => null,
        'status' => true,
    ]);
});

it('shows active kids items instead of menu items on the kids page', function () {
    KidsItem::factory()->create([
        'name' => 'Ghế ăn trẻ em',
        'type' => 'utensil',
        'status' => true,
    ]);

    KidsItem::factory()->create([
        'name' => 'Bộ đồ ăn đã ẩn',
        'type' => 'supply',
        'status' => false,
    ]);

    $this->get(route('menu.for-kids'))
        ->assertOk()
        ->assertSee('Ghế ăn trẻ em')
        ->assertSee('Dụng cụ')
        ->assertDontSee('Bộ đồ ăn đã ẩn');
});

it('filters kids food by category and sorts the results by name', function () {
    KidsItem::factory()->create([
        'name' => 'Zulu bò nướng',
        'type' => 'food',
        'food_category' => 'meat',
        'sort_order' => 1,
    ]);

    KidsItem::factory()->create([
        'name' => 'Alpha bò nướng',
        'type' => 'food',
        'food_category' => 'meat',
        'sort_order' => 2,
    ]);

    KidsItem::factory()->create([
        'name' => 'Bánh ngọt',
        'type' => 'food',
        'food_category' => 'dessert',
    ]);

    $response = $this->get(route('menu.for-kids', [
        'type' => 'food',
        'food_category' => 'meat',
        'sort' => 'name_asc',
    ]));

    $response->assertOk()
        ->assertSee('Alpha bò nướng')
        ->assertSee('Zulu bò nướng')
        ->assertDontSee('Bánh ngọt');

    expect(strpos($response->getContent(), 'Alpha bò nướng'))
        ->toBeLessThan(strpos($response->getContent(), 'Zulu bò nướng'));
});

it('filters kids items by type', function () {
    KidsItem::factory()->create([
        'name' => 'Mì cho bé',
        'type' => 'food',
    ]);

    KidsItem::factory()->create([
        'name' => 'Ghế ăn cho bé',
        'type' => 'utensil',
    ]);

    $this->get(route('menu.for-kids', ['type' => 'utensil']))
        ->assertOk()
        ->assertSee('Ghế ăn cho bé')
        ->assertDontSee('Mì cho bé');
});
