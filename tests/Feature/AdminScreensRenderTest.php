<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('admin screens render inside the shared responsive layout', function (string $routeName) {
    $this->actingAs(User::factory()->create())
        ->get(route($routeName))
        ->assertOk()
        ->assertSee('class="admin-sidebar"', false)
        ->assertSee('class="admin-topbar"', false)
        ->assertSee('data-admin-menu-toggle', false);
})->with([
    'dashboard' => ['admin.dashboard'],
    'banner list' => ['admin.menu.banners.index'],
    'category list' => ['admin.menu.categories.index'],
    'item list' => ['admin.menu.items.index'],
    'combo list' => ['admin.menu.combos.index'],
    'promotion list' => ['admin.menu.promotions.index'],
    'recipe list' => ['admin.menu.recipes.index'],
    'tip list' => ['admin.menu.tips.index'],
    'restaurant list' => ['admin.menu.restaurants.index'],
    'booking list' => ['admin.menu.bookings.index'],
    'lead list' => ['admin.menu.leads.index'],
    'settings' => ['admin.menu.settings.index'],
    'create banner' => ['admin.menu.banners.create'],
    'create category' => ['admin.menu.categories.create'],
    'create item' => ['admin.menu.items.create'],
    'create combo' => ['admin.menu.combos.create'],
    'create promotion' => ['admin.menu.promotions.create'],
    'create recipe' => ['admin.menu.recipes.create'],
    'create tip' => ['admin.menu.tips.create'],
    'create restaurant' => ['admin.menu.restaurants.create'],
    'create booking' => ['admin.menu.bookings.create'],
    'create lead' => ['admin.menu.leads.create'],
]);
