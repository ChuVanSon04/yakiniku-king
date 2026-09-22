<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('restaurant')
            ->orderByDesc('id')
            ->get();

        return view('admin.menu.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $restaurants = Restaurant::where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.menu.bookings.create',
            compact('restaurants')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',

            'customer_name' => 'required|string|max:255',

            'phone' => 'required|string|max:30',

            'email' => 'nullable|email|max:255',

            'booking_date' => 'required|date',

            'booking_time' => 'required|date_format:H:i',

            'number_of_guests' => 'required|integer|min:1|max:100',

            'note' => 'nullable|string',

            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $validated['booking_code'] = $this->generateBookingCode();

        Booking::create($validated);

        return redirect()
            ->route('admin.menu.bookings.index')
            ->with('success', 'Thêm booking thành công.');
    }

    public function show(Booking $booking)
    {
        return redirect()->route(
            'admin.menu.bookings.edit',
            $booking
        );
    }

    public function edit(Booking $booking)
    {
        $restaurants = Restaurant::orderBy('name')->get();

        return view(
            'admin.menu.bookings.edit',
            compact('booking', 'restaurants')
        );
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',

            'customer_name' => 'required|string|max:255',

            'phone' => 'required|string|max:30',

            'email' => 'nullable|email|max:255',

            'booking_date' => 'required|date',

            'booking_time' => 'required|date_format:H:i',

            'number_of_guests' => 'required|integer|min:1|max:100',

            'note' => 'nullable|string',

            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $booking->update($validated);

        return redirect()
            ->route('admin.menu.bookings.index')
            ->with('success', 'Cập nhật booking thành công.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()
            ->route('admin.menu.bookings.index')
            ->with('success', 'Xóa booking thành công.');
    }

    private function generateBookingCode(): string
    {
        do {
            $code = 'BK' . now()->format('YmdHis') . rand(10, 99);
        } while (Booking::where('booking_code', $code)->exists());

        return $code;
    }
}