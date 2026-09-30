<?php

use App\Models\Combo;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\ParallelTesting;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

function fakeAdminMenuUploadStorage(): void
{
    ParallelTesting::resolveTokenUsing(fn (): string => (string) getmypid());
    Storage::fake('public');
}

test('category creation stores an uploaded image', function () {
    fakeAdminMenuUploadStorage();

    $response = $this->actingAs(User::factory()->create())
        ->post(route('admin.menu.categories.store'), [
            'name' => 'Grill',
            'slug' => 'grill',
            'image' => UploadedFile::fake()->create('grill.jpg', 100, 'image/jpeg'),
        ]);

    $response->assertRedirect(route('admin.menu.categories.index'));

    $category = MenuCategory::firstOrFail();

    expect($category->image)->toStartWith('menu/categories/');
    Storage::disk('public')->assertExists($category->image);
});

test('category update replaces its uploaded image', function () {
    fakeAdminMenuUploadStorage();
    $oldImagePath = 'menu/categories/old.jpg';
    Storage::disk('public')->put($oldImagePath, 'old image');
    $category = MenuCategory::create([
        'name' => 'Grill',
        'slug' => 'grill',
        'image' => $oldImagePath,
    ]);

    $response = $this->actingAs(User::factory()->create())
        ->put(route('admin.menu.categories.update', $category), [
            'name' => 'Grill Updated',
            'slug' => 'grill-updated',
            'image' => UploadedFile::fake()->create('grill-updated.jpg', 100, 'image/jpeg'),
        ]);

    $response->assertRedirect(route('admin.menu.categories.index'));

    $category->refresh();

    expect($category->image)->toStartWith('menu/categories/');
    Storage::disk('public')->assertExists($category->image);
    Storage::disk('public')->assertMissing($oldImagePath);
});

test('menu item creation stores an uploaded image', function () {
    fakeAdminMenuUploadStorage();
    $category = MenuCategory::create([
        'name' => 'Grill',
        'slug' => 'grill',
    ]);

    $response = $this->actingAs(User::factory()->create())
        ->post(route('admin.menu.items.store'), [
            'category_id' => $category->id,
            'name' => 'Beef',
            'slug' => 'beef',
            'price' => 100,
            'image' => UploadedFile::fake()->create('beef.jpg', 100, 'image/jpeg'),
        ]);

    $response->assertRedirect(route('admin.menu.items.index'));

    $item = MenuItem::firstOrFail();

    expect($item->image)->toStartWith('menu/items/');
    Storage::disk('public')->assertExists($item->image);
});

test('menu item update replaces its uploaded image', function () {
    fakeAdminMenuUploadStorage();
    $category = MenuCategory::create([
        'name' => 'Grill',
        'slug' => 'grill',
    ]);
    $oldImagePath = 'menu/items/old.jpg';
    Storage::disk('public')->put($oldImagePath, 'old image');
    $item = MenuItem::create([
        'category_id' => $category->id,
        'name' => 'Beef',
        'slug' => 'beef',
        'price' => 100,
        'image' => $oldImagePath,
    ]);

    $response = $this->actingAs(User::factory()->create())
        ->put(route('admin.menu.items.update', $item), [
            'category_id' => $category->id,
            'name' => 'Beef Updated',
            'slug' => 'beef-updated',
            'price' => 120,
            'image' => UploadedFile::fake()->create('beef-updated.jpg', 100, 'image/jpeg'),
        ]);

    $response->assertRedirect(route('admin.menu.items.index'));

    $item->refresh();

    expect($item->image)->toStartWith('menu/items/');
    Storage::disk('public')->assertExists($item->image);
    Storage::disk('public')->assertMissing($oldImagePath);
});

test('combo creation stores an uploaded image', function () {
    fakeAdminMenuUploadStorage();

    $response = $this->actingAs(User::factory()->create())
        ->post(route('admin.menu.combos.store'), [
            'name' => 'Family Set',
            'slug' => 'family-set',
            'price' => 500,
            'image' => UploadedFile::fake()->create('family-set.jpg', 100, 'image/jpeg'),
        ]);

    $response->assertRedirect(route('admin.menu.combos.index'));

    $combo = Combo::firstOrFail();

    expect($combo->image)->toStartWith('menu/combos/');
    Storage::disk('public')->assertExists($combo->image);
});

test('combo update replaces its uploaded image', function () {
    fakeAdminMenuUploadStorage();
    $oldImagePath = 'menu/combos/old.jpg';
    Storage::disk('public')->put($oldImagePath, 'old image');
    $combo = Combo::create([
        'name' => 'Family Set',
        'slug' => 'family-set',
        'price' => 500,
        'image' => $oldImagePath,
    ]);

    $response = $this->actingAs(User::factory()->create())
        ->put(route('admin.menu.combos.update', $combo), [
            'name' => 'Family Set Updated',
            'slug' => 'family-set-updated',
            'price' => 550,
            'image' => UploadedFile::fake()->create('family-set-updated.jpg', 100, 'image/jpeg'),
        ]);

    $response->assertRedirect(route('admin.menu.combos.index'));

    $combo->refresh();

    expect($combo->image)->toStartWith('menu/combos/');
    Storage::disk('public')->assertExists($combo->image);
    Storage::disk('public')->assertMissing($oldImagePath);
});

test('updates without a new image keep the current images', function () {
    fakeAdminMenuUploadStorage();
    $categoryImagePath = 'menu/categories/current.jpg';
    $itemImagePath = 'menu/items/current.jpg';
    $comboImagePath = 'menu/combos/current.jpg';
    Storage::disk('public')->put($categoryImagePath, 'category image');
    Storage::disk('public')->put($itemImagePath, 'item image');
    Storage::disk('public')->put($comboImagePath, 'combo image');

    $category = MenuCategory::create([
        'name' => 'Grill',
        'slug' => 'grill',
        'image' => $categoryImagePath,
    ]);
    $item = MenuItem::create([
        'category_id' => $category->id,
        'name' => 'Beef',
        'slug' => 'beef',
        'price' => 100,
        'image' => $itemImagePath,
    ]);
    $combo = Combo::create([
        'name' => 'Family Set',
        'slug' => 'family-set',
        'price' => 500,
        'image' => $comboImagePath,
    ]);
    $user = User::factory()->create();

    $this->actingAs($user)
        ->put(route('admin.menu.categories.update', $category), [
            'name' => 'Grill Updated',
            'slug' => 'grill-updated',
        ])
        ->assertRedirect(route('admin.menu.categories.index'));

    $this->put(route('admin.menu.items.update', $item), [
        'category_id' => $category->id,
        'name' => 'Beef Updated',
        'slug' => 'beef-updated',
        'price' => 120,
    ])->assertRedirect(route('admin.menu.items.index'));

    $this->put(route('admin.menu.combos.update', $combo), [
        'name' => 'Family Set Updated',
        'slug' => 'family-set-updated',
        'price' => 550,
    ])->assertRedirect(route('admin.menu.combos.index'));

    expect($category->fresh()->image)->toBe($categoryImagePath)
        ->and($item->fresh()->image)->toBe($itemImagePath)
        ->and($combo->fresh()->image)->toBe($comboImagePath);

    Storage::disk('public')->assertExists($categoryImagePath);
    Storage::disk('public')->assertExists($itemImagePath);
    Storage::disk('public')->assertExists($comboImagePath);
});
