<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::orderByDesc('id')->get();

        return view(
            'admin.menu.recipes.index',
            compact('recipes')
        );
    }

    public function create()
    {
        return view('admin.menu.recipes.create');
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
                'unique:recipes,slug',
            ],

            'short_description' => [
                'nullable',
                'string',
            ],
            'short_description_en' => ['nullable', 'string', 'max:255'],

            'content' => [
                'nullable',
                'string',
            ],
            'content_en' => ['nullable', 'string'],

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
                ->store('recipes', 'public');
        }

        Recipe::create([
            'title' => $validated['title'],
            'title_en' => $validated['title_en'] ?? null,

            'slug' => $validated['slug'],

            'short_description' => $validated['short_description'] ?? null,
            'short_description_en' => $validated['short_description_en'] ?? null,

            'content' => $validated['content'] ?? null,
            'content_en' => $validated['content_en'] ?? null,

            'image' => $imagePath,

            'status' => $request->boolean('status'),

            'published_at' => $validated['published_at'] ?? null,
        ]);

        return redirect()
            ->route('admin.menu.recipes.index')
            ->with(
                'success',
                'Thêm công thức thành công.'
            );
    }

    public function edit(Recipe $recipe)
    {
        return view(
            'admin.menu.recipes.edit',
            compact('recipe')
        );
    }

    public function update(
        Request $request,
        Recipe $recipe
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
                'unique:recipes,slug,'.$recipe->id,
            ],

            'short_description' => [
                'nullable',
                'string',
            ],
            'short_description_en' => ['nullable', 'string', 'max:255'],

            'content' => [
                'nullable',
                'string',
            ],
            'content_en' => ['nullable', 'string'],

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

        $imagePath = $recipe->image;

        if ($request->hasFile('image')) {

            if ($recipe->image) {
                Storage::disk('public')
                    ->delete($recipe->image);
            }

            $imagePath = $request
                ->file('image')
                ->store('recipes', 'public');
        } elseif ($request->boolean('remove_image')) {
            if ($recipe->image) {
                Storage::disk('public')->delete($recipe->image);
            }

            $imagePath = null;
        }

        $recipe->update([
            'title' => $validated['title'],
            'title_en' => $validated['title_en'] ?? null,

            'slug' => $validated['slug'],

            'short_description' => $validated['short_description'] ?? null,
            'short_description_en' => $validated['short_description_en'] ?? null,

            'content' => $validated['content'] ?? null,
            'content_en' => $validated['content_en'] ?? null,

            'image' => $imagePath,

            'status' => $request->boolean('status'),

            'published_at' => $validated['published_at'] ?? null,
        ]);

        return redirect()
            ->route('admin.menu.recipes.index')
            ->with(
                'success',
                'Cập nhật công thức thành công.'
            );
    }

    public function destroy(Recipe $recipe)
    {
        if ($recipe->image) {
            Storage::disk('public')
                ->delete($recipe->image);
        }

        $recipe->delete();

        return redirect()
            ->route('admin.menu.recipes.index')
            ->with(
                'success',
                'Xóa công thức thành công.'
            );
    }
}
