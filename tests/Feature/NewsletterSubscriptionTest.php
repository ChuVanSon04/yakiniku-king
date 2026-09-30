<?php

use App\Models\Lead;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('a visitor can register for offers', function () {
    $response = $this->postJson(route('leads.store'), [
        'salutation' => 'Ông',
        'name' => 'Nguyen Van A',
        'email' => 'a@example.com',
        'phone' => '0901234567',
    ]);

    $response->assertCreated()
        ->assertJsonPath('message', 'Đăng ký nhận ưu đãi thành công.')
        ->assertJsonPath('lead.status', 'new');

    $this->assertDatabaseHas('leads', [
        'salutation' => 'Ông',
        'name' => 'Nguyen Van A',
        'email' => 'a@example.com',
        'phone' => '0901234567',
        'status' => 'new',
    ]);
});

test('offer registration requires a valid email', function () {
    $response = $this->postJson(route('leads.store'), [
        'salutation' => 'Ông',
        'name' => 'Nguyen Van A',
        'email' => 'invalid-email',
        'phone' => '0901234567',
    ]);

    $response->assertUnprocessable()
        ->assertJsonValidationErrors(['email']);

    expect(Lead::count())->toBe(0);
});

test('offer registration requires a salutation and phone number', function () {
    $response = $this->postJson(route('leads.store'), [
        'name' => 'Nguyen Van A',
        'email' => 'a@example.com',
    ]);

    $response->assertUnprocessable()
        ->assertJsonValidationErrors(['salutation', 'phone']);

    expect(Lead::count())->toBe(0);
});

test('offer registration only accepts ông or bà as salutation', function () {
    $response = $this->postJson(route('leads.store'), [
        'salutation' => 'Khác',
        'name' => 'Nguyen Van A',
        'email' => 'a@example.com',
        'phone' => '0901234567',
    ]);

    $response->assertUnprocessable()
        ->assertJsonValidationErrors(['salutation']);

    expect(Lead::count())->toBe(0);
});
