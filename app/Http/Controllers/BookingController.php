<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Restaurant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function create(): View
    {
        $restaurants = Restaurant::query()
            ->where('status', true)
            ->orderBy('name')
            ->get(['id', 'name']);

        $booking = Booking::query()
            ->with('restaurant')
            ->find(session('booking_id'));

        return view('fontend.bookings.create', compact('booking', 'restaurants'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'restaurant_id' => ['required', 'integer', Rule::exists('restaurants', 'id')->where('status', true)],
            'customer_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'booking_date' => ['required', 'date', 'after_or_equal:today'],
            'booking_time' => ['required', 'date_format:H:i'],
            'number_of_guests' => ['required', 'integer', 'between:1,100'],
            'note' => ['nullable', 'string', 'max:2000'],
        ]);

        $bookingCode = $this->generateBookingCode();

        $booking = Booking::create([
            ...$validated,
            'booking_code' => $bookingCode,
            'qr_code' => $bookingCode,
            'status' => 'pending',
        ]);

        $request->session()->put('booking_id', $booking->id);

        return to_route('booking.create')
            ->with('booking_success', true)
            ->with('booking_code', $booking->booking_code);
    }

    public function cancel(Request $request): RedirectResponse
    {
        $bookingId = $request->session()->get('booking_id');

        abort_if($bookingId === null, 404);

        $booking = Booking::query()->findOrFail($bookingId);

        if (in_array($booking->status, ['pending', 'confirmed'], true)) {
            $booking->update(['status' => 'cancelled']);
        }

        $request->session()->forget('booking_id');

        return to_route('booking.create')
            ->with('booking_cancelled', true);
    }

    private function generateBookingCode(): string
    {
        do {
            $bookingCode = 'BK'.now()->format('YmdHis').Str::upper(Str::random(4));
        } while (Booking::query()->where('booking_code', $bookingCode)->exists());

        return $bookingCode;
    }
}
