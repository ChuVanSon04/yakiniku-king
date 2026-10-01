<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Combo;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ComboController extends Controller
{
    /**
     * Danh sách Combo
     */
    public function index()
    {
        $combos = Combo::with('menuItems')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view(
            'admin.menu.combos.index',
            compact('combos')
        );
    }

    /**
     * Form thêm Combo
     */
    public function create()
    {
        $menuItems = MenuItem::where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.menu.combos.create',
            compact('menuItems')
        );
    }

    /**
     * Lưu Combo
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'name_en' => ['nullable', 'string', 'max:255'],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:combos,slug',
            ],

            'description' => [
                'nullable',
                'string',
            ],
            'description_en' => ['nullable', 'string'],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
            'remove_image' => ['nullable', 'boolean'],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'original_price' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'start_date' => [
                'nullable',
                'date',
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],

            'items' => [
                'nullable',
                'array',
            ],

            'items.*.menu_item_id' => [
                'required',
                'exists:menu_items,id',
            ],

            'items.*.quantity' => [
                'required',
                'integer',
                'min:1',
            ],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug(
                $validated['name']
            );
        }

        $validated['sort_order'] =
            $validated['sort_order'] ?? 0;

        $validated['status'] =
            $request->boolean('status');

        $validated['image'] = $request->file('image')?->store('menu/combos', 'public');

        DB::transaction(function () use (
            $validated,
            $request
        ) {

            $combo = Combo::create([
                'name' => $validated['name'],
                'name_en' => $validated['name_en'] ?? null,
                'slug' => $validated['slug'],
                'description' => $validated['description'] ?? null,
                'description_en' => $validated['description_en'] ?? null,
                'image' => $validated['image'] ?? null,
                'price' => $validated['price'],
                'original_price' => $validated['original_price'] ?? null,
                'start_date' => $validated['start_date'] ?? null,
                'end_date' => $validated['end_date'] ?? null,
                'status' => $request->boolean('status'),
                'sort_order' => $validated['sort_order'],
            ]);

            $items = [];

            foreach ($request->input('items', []) as $item) {

                $items[$item['menu_item_id']] = [
                    'quantity' => $item['quantity'],
                ];
            }

            $combo->menuItems()->sync($items);
        });

        return redirect()
            ->route('admin.menu.combos.index')
            ->with(
                'success',
                'Thêm Combo thành công.'
            );
    }

    /**
     * Form sửa Combo
     */
    public function edit(Combo $combo)
    {
        $menuItems = MenuItem::where('status', true)
            ->orderBy('name')
            ->get();

        $combo->load('menuItems');

        return view(
            'admin.menu.combos.edit',
            compact(
                'combo',
                'menuItems'
            )
        );
    }

    /**
     * Cập nhật Combo
     */
    public function update(
        Request $request,
        Combo $combo
    ) {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'name_en' => ['nullable', 'string', 'max:255'],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:combos,slug,'.$combo->id,
            ],

            'description' => [
                'nullable',
                'string',
            ],
            'description_en' => ['nullable', 'string'],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'original_price' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'start_date' => [
                'nullable',
                'date',
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],

            'items' => [
                'nullable',
                'array',
            ],

            'items.*.menu_item_id' => [
                'required',
                'exists:menu_items,id',
            ],

            'items.*.quantity' => [
                'required',
                'integer',
                'min:1',
            ],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug(
                $validated['name']
            );
        }

        $imagePath = $combo->image;
        $oldImagePath = $combo->image;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menu/combos', 'public');
        } elseif ($request->boolean('remove_image')) {
            $imagePath = null;
        }

        $combo->update([
            'name' => $validated['name'],
            'name_en' => $validated['name_en'] ?? null,
            'slug' => $validated['slug'],
            'description' => $validated['description'] ?? null,
            'description_en' => $validated['description_en'] ?? null,
            'image' => $imagePath,
            'price' => $validated['price'],
            'original_price' => $validated['original_price'] ?? null,
            'start_date' => $validated['start_date'] ?? null,
            'end_date' => $validated['end_date'] ?? null,
            'status' => $request->boolean('status'),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        $items = [];

        foreach ($request->input('items', []) as $item) {

            $items[$item['menu_item_id']] = [
                'quantity' => $item['quantity'],
            ];
        }

        $combo->menuItems()->sync($items);

        if (($request->hasFile('image') || $request->boolean('remove_image')) && $oldImagePath) {
            Storage::disk('public')->delete($oldImagePath);
        }

        return redirect()
            ->route('admin.menu.combos.index')
            ->with(
                'success',
                'Cập nhật Combo thành công.'
            );
    }

    /**
     * Xóa Combo
     */
    public function destroy(Combo $combo)
    {
        $combo->delete();

        return redirect()
            ->route('admin.menu.combos.index')
            ->with(
                'success',
                'Xóa Combo thành công.'
            );
    }
}
