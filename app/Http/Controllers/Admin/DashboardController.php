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
        $menuItemsCount = MenuItem::count();

        $combosCount = Combo::count();

        $promotionsCount = Promotion::count();

        $restaurantsCount = Restaurant::count();

        $bookingsCount = Booking::count();

        $newLeadsCount = Lead::where('status', 'new')->count();

        $recentBookings = Booking::with('restaurant')
            ->orderByDesc('id')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'menuItemsCount',
            'combosCount',
            'promotionsCount',
            'restaurantsCount',
            'bookingsCount',
            'newLeadsCount',
            'recentBookings'
        ));
    }
}
