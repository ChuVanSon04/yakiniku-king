<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.menu.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.menu.banners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'title_en' => ['nullable', 'string', 'max:255'],

            'type' => [
                'required',
                'in:image,video',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'video_url' => [
                'nullable',
                'url',
                'max:255',
            ],

            'link' => [
                'nullable',
                'string',
                'max:255',
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
        ]);

        /*
        |--------------------------------------------------------------------------
        | Upload image
        |--------------------------------------------------------------------------
        */

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request
                ->file('image')
                ->store('banners', 'public');
        }

        Banner::create([
            'title' => $validated['title'] ?? null,
            'title_en' => $validated['title_en'] ?? null,

            'type' => $validated['type'],

            'image' => $imagePath,

            'video_url' => $validated['video_url'] ?? null,

            'link' => $validated['link'] ?? null,

            'sort_order' => $validated['sort_order'] ?? 0,

            'status' => $request->boolean('status'),
        ]);

        return redirect()
            ->route('admin.menu.banners.index')
            ->with('success', 'Thêm Banner thành công.');
    }

    public function edit(Banner $banner)
    {
        return view('admin.menu.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'title_en' => ['nullable', 'string', 'max:255'],

            'type' => [
                'required',
                'in:image,video',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
            'remove_image' => ['nullable', 'boolean'],

            'video_url' => [
                'nullable',
                'url',
                'max:255',
            ],

            'link' => [
                'nullable',
                'string',
                'max:255',
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
        ]);

        $imagePath = $banner->image;

        /*
        |--------------------------------------------------------------------------
        | Nếu upload ảnh mới
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }

            $imagePath = $request
                ->file('image')
                ->store('banners', 'public');
        } elseif ($request->boolean('remove_image')) {
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }

            $imagePath = null;
        }

        $banner->update([
            'title' => $validated['title'] ?? null,
            'title_en' => $validated['title_en'] ?? null,

            'type' => $validated['type'],

            'image' => $imagePath,

            'video_url' => $validated['video_url'] ?? null,

            'link' => $validated['link'] ?? null,

            'sort_order' => $validated['sort_order'] ?? 0,

            'status' => $request->boolean('status'),
        ]);

        return redirect()
            ->route('admin.menu.banners.index')
            ->with('success', 'Cập nhật Banner thành công.');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->image) {
            Storage::disk('public')->delete($banner->image);
        }

        $banner->delete();

        return redirect()
            ->route('admin.menu.banners.index')
            ->with('success', 'Xóa Banner thành công.');
    }
}
