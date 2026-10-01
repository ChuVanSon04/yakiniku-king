<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::orderBy('name')->get();

        return view('admin.menu.restaurants.index', compact('restaurants'));
    }

    public function create()
    {
        return view('admin.menu.restaurants.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',

            'phone' => 'nullable|string|max:30',

            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',

            'google_map_url' => 'nullable|url|max:255',

            'opening_time' => 'nullable|date_format:H:i',
            'closing_time' => 'nullable|date_format:H:i',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',

            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request
                ->file('image')
                ->store('restaurants', 'public');
        }

        $validated['status'] = $request->boolean('status');

        Restaurant::create($validated);

        return redirect()
            ->route('admin.menu.restaurants.index')
            ->with('success', 'Thêm nhà hàng thành công.');
    }

    public function show(Restaurant $restaurant)
    {
        return redirect()->route(
            'admin.menu.restaurants.edit',
            $restaurant
        );
    }

    public function edit(Restaurant $restaurant)
    {
        return view('admin.menu.restaurants.edit', compact('restaurant'));
    }

    public function update(Request $request, Restaurant $restaurant)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',

            'phone' => 'nullable|string|max:30',

            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',

            'google_map_url' => 'nullable|url|max:255',

            'opening_time' => 'nullable|date_format:H:i',
            'closing_time' => 'nullable|date_format:H:i',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'remove_image' => 'nullable|boolean',

            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {

            if ($restaurant->image) {
                Storage::disk('public')->delete($restaurant->image);
            }

            $validated['image'] = $request
                ->file('image')
                ->store('restaurants', 'public');
        } elseif ($request->boolean('remove_image')) {
            if ($restaurant->image) {
                Storage::disk('public')->delete($restaurant->image);
            }

            $validated['image'] = null;
        }

        unset($validated['remove_image']);
        $validated['status'] = $request->boolean('status');

        $restaurant->update($validated);

        return redirect()
            ->route('admin.menu.restaurants.index')
            ->with('success', 'Cập nhật nhà hàng thành công.');
    }

    public function destroy(Restaurant $restaurant)
    {
        if ($restaurant->image) {
            Storage::disk('public')->delete($restaurant->image);
        }

        $restaurant->delete();

        return redirect()
            ->route('admin.menu.restaurants.index')
            ->with('success', 'Xóa nhà hàng thành công.');
    }
}
