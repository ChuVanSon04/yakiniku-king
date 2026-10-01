<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KidsItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class KidsItemController extends Controller
{
    private const TYPE_LABELS = [
        'food' => 'Đồ ăn',
        'utensil' => 'Dụng cụ',
        'supply' => 'Đồ dùng',
    ];

    private const FOOD_CATEGORY_LABELS = [
        'meat' => 'Thịt',
        'side_dish' => 'Món ăn kèm',
        'vegetable' => 'Rau củ',
        'soup' => 'Súp',
        'rice_noodles' => 'Cơm và mì',
        'dessert' => 'Tráng miệng',
    ];

    public function index(): View
    {
        $items = KidsItem::query()
            ->orderBy('type')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.kids-items.index', [
            'items' => $items,
            'typeLabels' => self::TYPE_LABELS,
            'foodCategoryLabels' => self::FOOD_CATEGORY_LABELS,
        ]);
    }

    public function create(): View
    {
        return view('admin.kids-items.create', [
            'typeLabels' => self::TYPE_LABELS,
            'foodCategoryLabels' => self::FOOD_CATEGORY_LABELS,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name_en' => ['nullable', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:kids_items,slug'],
            'type' => ['required', 'in:food,utensil,supply'],
            'food_category' => ['nullable', 'in:meat,side_dish,vegetable,soup,rice_noodles,dessert'],
            'description' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'remove_image' => ['nullable', 'boolean'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['nullable', 'boolean'],
        ]);

        $validated['slug'] = Str::slug(($validated['slug'] ?? null) ?: $validated['name']);
        $validated['image'] = $request->file('image')?->store('kids/items', 'public');
        $validated['food_category'] = $validated['type'] === 'food'
            ? ($validated['food_category'] ?? null)
            : null;
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['status'] = $request->boolean('status');

        KidsItem::create($validated);

        return redirect()
            ->route('admin.kids-items.index')
            ->with('success', 'Thêm nội dung trẻ em thành công.');
    }

    public function edit(KidsItem $kidsItem): View
    {
        return view('admin.kids-items.edit', [
            'kidsItem' => $kidsItem,
            'typeLabels' => self::TYPE_LABELS,
            'foodCategoryLabels' => self::FOOD_CATEGORY_LABELS,
        ]);
    }

    public function update(Request $request, KidsItem $kidsItem): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name_en' => ['nullable', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:kids_items,slug,'.$kidsItem->id],
            'type' => ['required', 'in:food,utensil,supply'],
            'food_category' => ['nullable', 'in:meat,side_dish,vegetable,soup,rice_noodles,dessert'],
            'description' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['nullable', 'boolean'],
        ]);

        $validated['slug'] = Str::slug(($validated['slug'] ?? null) ?: $validated['name']);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('kids/items', 'public');

            if ($kidsItem->image) {
                Storage::disk('public')->delete($kidsItem->image);
            }

            $validated['image'] = $imagePath;
        } elseif ($request->boolean('remove_image')) {
            if ($kidsItem->image) {
                Storage::disk('public')->delete($kidsItem->image);
            }

            $validated['image'] = null;
        } else {
            unset($validated['image']);
        }

        unset($validated['remove_image']);
        $validated['food_category'] = $validated['type'] === 'food'
            ? ($validated['food_category'] ?? null)
            : null;
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['status'] = $request->boolean('status');

        $kidsItem->update($validated);

        return redirect()
            ->route('admin.kids-items.index')
            ->with('success', 'Cập nhật nội dung trẻ em thành công.');
    }

    public function destroy(KidsItem $kidsItem): RedirectResponse
    {
        if ($kidsItem->image) {
            Storage::disk('public')->delete($kidsItem->image);
        }

        $kidsItem->delete();

        return redirect()
            ->route('admin.kids-items.index')
            ->with('success', 'Xóa nội dung trẻ em thành công.');
    }
}
