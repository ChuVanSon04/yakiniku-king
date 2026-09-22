<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuItemController extends Controller
{
    public function index()
    {
        $items = MenuItem::with('category')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.menu.items.index', compact('items'));
    }

    public function create()
    {
        $categories = MenuCategory::where('status', true)
            ->orderBy('sort_order')
            ->get();

        return view(
            'admin.menu.items.create',
            compact('categories')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:menu_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:menu_items,slug'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_must_try' => ['nullable', 'boolean'],
            'is_for_kids' => ['nullable', 'boolean'],
            'status' => ['nullable', 'boolean'],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_must_try'] = $request->boolean('is_must_try');
        $validated['is_for_kids'] = $request->boolean('is_for_kids');
        $validated['status'] = $request->boolean('status');

        MenuItem::create($validated);

        return redirect()
            ->route('admin.menu.items.index')
            ->with('success', 'Thêm món ăn thành công.');
    }

    public function edit(MenuItem $item)
    {
        $categories = MenuCategory::where('status', true)
            ->orderBy('sort_order')
            ->get();

        return view(
            'admin.menu.items.edit',
            compact('item', 'categories')
        );
    }

    public function update(Request $request, MenuItem $item)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:menu_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:menu_items,slug,' . $item->id,
            ],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_must_try' => ['nullable', 'boolean'],
            'is_for_kids' => ['nullable', 'boolean'],
            'status' => ['nullable', 'boolean'],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_must_try'] = $request->boolean('is_must_try');
        $validated['is_for_kids'] = $request->boolean('is_for_kids');
        $validated['status'] = $request->boolean('status');

        $item->update($validated);

        return redirect()
            ->route('admin.menu.items.index')
            ->with('success', 'Cập nhật món ăn thành công.');
    }

    public function destroy(MenuItem $item)
    {
        $item->delete();

        return redirect()
            ->route('admin.menu.items.index')
            ->with('success', 'Xóa món ăn thành công.');
    }
}