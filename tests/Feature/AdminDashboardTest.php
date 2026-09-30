<?php

use App\Models\Booking;
use App\Models\Lead;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('dashboard summarizes today bookings, pending bookings, new leads, and the seven day trend', function () {
    $restaurant = Restaurant::create([
        'name' => 'Yakiniku King - Hà Nội',
        'address' => 'Hà Nội',
    ]);

    Booking::create([
        'booking_code' => 'BK-TODAY-01',
        'restaurant_id' => $restaurant->id,
        'customer_name' => 'Nguyễn An',
        'phone' => '0900000001',
        'booking_date' => today()->toDateString(),
        'booking_time' => '18:00',
        'number_of_guests' => 2,
        'status' => 'pending',
    ]);

    Booking::create([
        'booking_code' => 'BK-TODAY-02',
        'restaurant_id' => $restaurant->id,
        'customer_name' => 'Trần Bình',
        'phone' => '0900000002',
        'booking_date' => today()->toDateString(),
        'booking_time' => '19:00',
        'number_of_guests' => 4,
        'status' => 'confirmed',
    ]);

    Booking::create([
        'booking_code' => 'BK-OLD-01',
        'restaurant_id' => $restaurant->id,
        'customer_name' => 'Lê Minh',
        'phone' => '0900000003',
        'booking_date' => today()->subDays(8)->toDateString(),
        'booking_time' => '20:00',
        'number_of_guests' => 3,
        'status' => 'cancelled',
    ]);

    Lead::create([
        'name' => 'Khách hàng mới',
        'phone' => '0900000004',
        'status' => 'new',
    ]);

    Lead::create([
        'name' => 'Khách đã liên hệ',
        'phone' => '0900000005',
        'status' => 'contacted',
    ]);

    $response = $this->actingAs(User::factory()->create())
        ->get(route('admin.dashboard'));

    $response->assertOk()
        ->assertViewHas('todayBookingsCount', 2)
        ->assertViewHas('pendingBookingsCount', 1)
        ->assertViewHas('newLeadsCount', 1)
        ->assertViewHas('bookingTrend', function ($bookingTrend): bool {
            expect($bookingTrend)->toHaveCount(7);
            expect($bookingTrend->sum('count'))->toBe(2);
            expect($bookingTrend->last()['count'])->toBe(2);

            return true;
        })
        ->assertViewHas('recentLeads', function ($recentLeads): bool {
            return $recentLeads->count() === 1
                && $recentLeads->first()->name === 'Khách hàng mới';
        });
});

test('dashboard redirects to login when the admin session has ended', function () {
    $this->get(route('admin.dashboard'))
        ->assertRedirect(route('admin.login'));

    $this->actingAs(User::factory()->create())
        ->post(route('admin.logout'))
        ->assertRedirect(route('admin.login'));

    $this->get(route('admin.dashboard'))
        ->assertRedirect(route('admin.login'));
});

test('authenticated admin pages are marked as non-cacheable', function () {
    $response = $this->actingAs(User::factory()->create())
        ->get(route('admin.dashboard'))
        ->assertOk();

    expect($response->headers->get('Cache-Control'))->toContain('no-store');
});
