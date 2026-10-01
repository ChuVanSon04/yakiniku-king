<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::orderByDesc('id')->get();

        return view(
            'admin.menu.promotions.index',
            compact('promotions')
        );
    }

    public function create()
    {
        return view('admin.menu.promotions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'title_en' => ['nullable', 'string', 'max:255'],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:promotions,slug',
            ],

            'short_description' => [
                'nullable',
                'string',
            ],
            'short_description_en' => ['nullable', 'string', 'max:255'],

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

            'start_date' => [
                'nullable',
                'date',
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Tạo slug tự động
        |--------------------------------------------------------------------------
        */

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug(
                $validated['title']
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Upload image
        |--------------------------------------------------------------------------
        */

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request
                ->file('image')
                ->store('promotions', 'public');
        }

        Promotion::create([
            'title' => $validated['title'],
            'title_en' => $validated['title_en'] ?? null,

            'slug' => $validated['slug'],

            'short_description' => $validated['short_description'] ?? null,
            'short_description_en' => $validated['short_description_en'] ?? null,

            'description' => $validated['description'] ?? null,
            'description_en' => $validated['description_en'] ?? null,

            'image' => $imagePath,

            'start_date' => $validated['start_date'] ?? null,

            'end_date' => $validated['end_date'] ?? null,

            'status' => $request->boolean('status'),
        ]);

        return redirect()
            ->route('admin.menu.promotions.index')
            ->with(
                'success',
                'Thêm khuyến mãi thành công.'
            );
    }

    public function edit(Promotion $promotion)
    {
        return view(
            'admin.menu.promotions.edit',
            compact('promotion')
        );
    }

    public function update(
        Request $request,
        Promotion $promotion
    ) {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'title_en' => ['nullable', 'string', 'max:255'],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:promotions,slug,'.$promotion->id,
            ],

            'short_description' => [
                'nullable',
                'string',
            ],
            'short_description_en' => ['nullable', 'string', 'max:255'],

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

            'start_date' => [
                'nullable',
                'date',
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug(
                $validated['title']
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Giữ ảnh cũ nếu không upload ảnh mới
        |--------------------------------------------------------------------------
        */

        $imagePath = $promotion->image;

        if ($request->hasFile('image')) {

            if ($promotion->image) {
                Storage::disk('public')
                    ->delete($promotion->image);
            }

            $imagePath = $request
                ->file('image')
                ->store('promotions', 'public');
        } elseif ($request->boolean('remove_image')) {
            if ($promotion->image) {
                Storage::disk('public')->delete($promotion->image);
            }

            $imagePath = null;
        }

        $promotion->update([
            'title' => $validated['title'],
            'title_en' => $validated['title_en'] ?? null,

            'slug' => $validated['slug'],

            'short_description' => $validated['short_description'] ?? null,
            'short_description_en' => $validated['short_description_en'] ?? null,

            'description' => $validated['description'] ?? null,
            'description_en' => $validated['description_en'] ?? null,

            'image' => $imagePath,

            'start_date' => $validated['start_date'] ?? null,

            'end_date' => $validated['end_date'] ?? null,

            'status' => $request->boolean('status'),
        ]);

        return redirect()
            ->route('admin.menu.promotions.index')
            ->with(
                'success',
                'Cập nhật khuyến mãi thành công.'
            );
    }

    public function destroy(Promotion $promotion)
    {
        if ($promotion->image) {
            Storage::disk('public')
                ->delete($promotion->image);
        }

        $promotion->delete();

        return redirect()
            ->route('admin.menu.promotions.index')
            ->with(
                'success',
                'Xóa khuyến mãi thành công.'
            );
    }
}
