<?php

use App\Models\Lead;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('a visitor can register for offers', function () {
    $response = $this->postJson(route('leads.store'), [
        'name' => 'Nguyen Van A',
        'email' => 'a@example.com',
        'phone' => '0901234567',
    ]);

    $response->assertCreated()
        ->assertJsonPath('message', 'Đăng ký nhận ưu đãi thành công.')
        ->assertJsonPath('lead.status', 'new');

    $this->assertDatabaseHas('leads', [
        'name' => 'Nguyen Van A',
        'email' => 'a@example.com',
        'phone' => '0901234567',
        'status' => 'new',
    ]);
});

test('offer registration requires a valid email', function () {
    $response = $this->postJson(route('leads.store'), [
        'name' => 'Nguyen Van A',
        'email' => 'invalid-email',
    ]);

    $response->assertUnprocessable()
        ->assertJsonValidationErrors(['email']);

    expect(Lead::count())->toBe(0);
});
