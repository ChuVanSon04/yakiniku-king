<?php

use App\Models\Booking;
use App\Models\Restaurant;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the home booking buttons open the public booking form', function () {
    $this->get(route('home'))
        ->assertSee('href="'.route('booking.create').'"', false);
});

test('the booking form lists active restaurants', function () {
    $restaurant = Restaurant::create([
        'name' => 'Yakiniku King - Hà Nội',
        'address' => 'Hà Nội',
        'status' => true,
    ]);

    $this->get(route('booking.create'))
        ->assertOk()
        ->assertSee('Đặt bàn')
        ->assertSee($restaurant->name);
});

test('a visitor can submit a booking request', function () {
    $restaurant = Restaurant::create([
        'name' => 'Yakiniku King - Hà Nội',
        'address' => 'Hà Nội',
        'status' => true,
    ]);

    $bookingDate = now()->addDay()->toDateString();

    $this->post(route('booking.store'), [
        'restaurant_id' => $restaurant->id,
        'customer_name' => 'Nguyen Van A',
        'phone' => '0901234567',
        'email' => 'a@example.com',
        'booking_date' => $bookingDate,
        'booking_time' => '19:00',
        'number_of_guests' => 2,
        'note' => 'Bàn gần cửa sổ',
    ])
        ->assertRedirect(route('booking.create'))
        ->assertSessionHas('booking_success')
        ->assertSessionHas('booking_code');

    $this->assertDatabaseHas('bookings', [
        'restaurant_id' => $restaurant->id,
        'customer_name' => 'Nguyen Van A',
        'phone' => '0901234567',
        'number_of_guests' => 2,
        'status' => 'pending',
        'note' => 'Bàn gần cửa sổ',
    ]);

    $booking = Booking::query()
        ->where('customer_name', 'Nguyen Van A')
        ->firstOrFail();

    expect($booking->booking_date->toDateString())->toBe($bookingDate);
    expect($booking->booking_time)->toBe('19:00');
    expect($booking->qr_code)->toBe($booking->booking_code);

    $this->get(route('booking.create'))
        ->assertSee('id="bookingConfirmationModal"', false)
        ->assertSee('Chưa xác nhận')
        ->assertSee('Nguyen Van A')
        ->assertSee('Bàn gần cửa sổ')
        ->assertSee('Ẩn thông tin')
        ->assertSee('Hủy đặt bàn')
        ->assertSee('Trở về trang chủ');
});

test('a visitor can cancel the booking in their session', function () {
    $restaurant = Restaurant::create([
        'name' => 'Yakiniku King - Hà Nội',
        'address' => 'Hà Nội',
        'status' => true,
    ]);

    $this->post(route('booking.store'), [
        'restaurant_id' => $restaurant->id,
        'customer_name' => 'Nguyen Van A',
        'phone' => '0901234567',
        'booking_date' => now()->addDay()->toDateString(),
        'booking_time' => '19:00',
        'number_of_guests' => 2,
    ]);

    $booking = Booking::query()->where('customer_name', 'Nguyen Van A')->firstOrFail();

    $this->post(route('booking.cancel'))
        ->assertRedirect(route('booking.create'))
        ->assertSessionHas('booking_cancelled');

    $this->assertDatabaseHas('bookings', [
        'id' => $booking->id,
        'status' => 'cancelled',
    ]);

    $this->get(route('booking.create'))
        ->assertDontSee('id="bookingConfirmationModal"', false);
});

test('a visitor cannot cancel a booking from another session', function () {
    $this->post(route('booking.cancel'))
        ->assertNotFound();
});

test('invalid booking details are rejected without creating a booking', function () {
    $this->from(route('booking.create'))
        ->post(route('booking.store'), [])
        ->assertRedirect(route('booking.create'))
        ->assertSessionHasErrors([
            'restaurant_id',
            'customer_name',
            'phone',
            'booking_date',
            'booking_time',
            'number_of_guests',
        ]);

    $this->assertDatabaseCount('bookings', 0);
});

test('inactive restaurants cannot receive public bookings', function () {
    $restaurant = Restaurant::create([
        'name' => 'Yakiniku King - Ngừng hoạt động',
        'address' => 'Hà Nội',
        'status' => false,
    ]);

    $this->from(route('booking.create'))
        ->post(route('booking.store'), [
            'restaurant_id' => $restaurant->id,
            'customer_name' => 'Nguyen Van A',
            'phone' => '0901234567',
            'booking_date' => now()->addDay()->toDateString(),
            'booking_time' => '19:00',
            'number_of_guests' => 2,
        ])
        ->assertRedirect(route('booking.create'))
        ->assertSessionHasErrors(['restaurant_id']);

    $this->assertDatabaseCount('bookings', 0);
});
