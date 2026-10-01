<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TipController extends Controller
{
    public function index()
    {
        $tips = Tip::orderByDesc('id')->get();

        return view(
            'admin.menu.tips.index',
            compact('tips')
        );
    }

    public function create()
    {
        return view('admin.menu.tips.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:tips,slug',
            ],

            'short_description' => [
                'nullable',
                'string',
            ],

            'content' => [
                'nullable',
                'string',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'published_at' => [
                'nullable',
                'date',
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
                ->store('tips', 'public');
        }

        Tip::create([
            'title' => $validated['title'],

            'slug' => $validated['slug'],

            'short_description' => $validated['short_description'] ?? null,

            'content' => $validated['content'] ?? null,

            'image' => $imagePath,

            'status' => $request->boolean('status'),

            'published_at' => $validated['published_at'] ?? null,
        ]);

        return redirect()
            ->route('admin.menu.tips.index')
            ->with(
                'success',
                'Thêm bí kíp thành công.'
            );
    }

    public function edit(Tip $tip)
    {
        return view(
            'admin.menu.tips.edit',
            compact('tip')
        );
    }

    public function update(
        Request $request,
        Tip $tip
    ) {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:tips,slug,'.$tip->id,
            ],

            'short_description' => [
                'nullable',
                'string',
            ],

            'content' => [
                'nullable',
                'string',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
            'remove_image' => ['nullable', 'boolean'],

            'published_at' => [
                'nullable',
                'date',
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

        $imagePath = $tip->image;

        if ($request->hasFile('image')) {

            if ($tip->image) {
                Storage::disk('public')
                    ->delete($tip->image);
            }

            $imagePath = $request
                ->file('image')
                ->store('tips', 'public');
        } elseif ($request->boolean('remove_image')) {
            if ($tip->image) {
                Storage::disk('public')->delete($tip->image);
            }

            $imagePath = null;
        }

        $tip->update([
            'title' => $validated['title'],

            'slug' => $validated['slug'],

            'short_description' => $validated['short_description'] ?? null,

            'content' => $validated['content'] ?? null,

            'image' => $imagePath,

            'status' => $request->boolean('status'),

            'published_at' => $validated['published_at'] ?? null,
        ]);

        return redirect()
            ->route('admin.menu.tips.index')
            ->with(
                'success',
                'Cập nhật bí kíp thành công.'
            );
    }

    public function destroy(Tip $tip)
    {
        if ($tip->image) {
            Storage::disk('public')
                ->delete($tip->image);
        }

        $tip->delete();

        return redirect()
            ->route('admin.menu.tips.index')
            ->with(
                'success',
                'Xóa bí kíp thành công.'
            );
    }
}
