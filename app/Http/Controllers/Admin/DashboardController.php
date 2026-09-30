<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Combo;
use App\Models\Lead;
use App\Models\MenuItem;
use App\Models\Promotion;
use App\Models\Restaurant;

class DashboardController extends Controller
{
    public function index()
    {
        $today = today();
        $weekStart = $today->copy()->subDays(6);

        $menuItemsCount = MenuItem::count();

        $combosCount = Combo::count();

        $promotionsCount = Promotion::count();

        $restaurantsCount = Restaurant::count();

        $bookingsCount = Booking::count();

        $todayBookingsCount = Booking::whereDate('booking_date', $today)->count();

        $pendingBookingsCount = Booking::where('status', 'pending')->count();

        $newLeadsCount = Lead::where('status', 'new')->count();

        $bookingCountsByDate = Booking::query()
            ->whereDate('booking_date', '>=', $weekStart->toDateString())
            ->whereDate('booking_date', '<=', $today->toDateString())
            ->selectRaw('DATE(booking_date) as booking_day, COUNT(*) as total')
            ->groupBy('booking_day')
            ->pluck('total', 'booking_day');

        $bookingTrend = collect(range(6, 0))->map(function (int $daysAgo) use ($today, $bookingCountsByDate): array {
            $date = $today->copy()->subDays($daysAgo);

            return [
                'date' => $date->toDateString(),
                'label' => $date->format('d/m'),
                'weekday' => $date->locale('vi')->isoFormat('dd'),
                'count' => (int) $bookingCountsByDate->get($date->toDateString(), 0),
            ];
        });

        $bookingTrendMax = max(1, (int) $bookingTrend->max('count'));

        $recentBookings = Booking::with('restaurant')
            ->orderByDesc('id')
            ->take(5)
            ->get();

        $recentLeads = Lead::query()
            ->where('status', 'new')
            ->latest()
            ->take(4)
            ->get();

        return view('admin.dashboard', compact(
            'menuItemsCount',
            'combosCount',
            'promotionsCount',
            'restaurantsCount',
            'bookingsCount',
            'todayBookingsCount',
            'pendingBookingsCount',
            'newLeadsCount',
            'recentBookings',
            'recentLeads',
            'bookingTrend',
            'bookingTrendMax'
        ));
    }
}
