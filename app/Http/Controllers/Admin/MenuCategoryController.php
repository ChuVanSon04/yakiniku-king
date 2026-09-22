<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuCategoryController extends Controller
{
    /**
     * Hiển thị danh sách category
     */
    public function index()
    {
        $categories = MenuCategory::orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.menu.categories.index', compact('categories'));
    }

    /**
     * Hiển thị form tạo category
     */
    public function create()
    {
        return view('admin.menu.categories.create');
    }

    /**
     * Lưu category mới
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:menu_categories,slug'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['nullable', 'boolean'],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['status'] = $request->boolean('status');

        MenuCategory::create($validated);

        return redirect()
            ->route('admin.menu.categories.index')
            ->with('success', 'Thêm danh mục thành công.');
    }

    /**
     * Hiển thị form sửa category
     */
    public function edit(MenuCategory $category)
    {
        return view(
            'admin.menu.categories.edit',
            compact('category')
        );
    }

    /**
     * Cập nhật category
     */
    public function update(Request $request, MenuCategory $category)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:menu_categories,slug,' . $category->id,
            ],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['nullable', 'boolean'],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['status'] = $request->boolean('status');

        $category->update($validated);

        return redirect()
            ->route('admin.menu.categories.index')
            ->with('success', 'Cập nhật danh mục thành công.');
    }

    /**
     * Xóa category
     */
    public function destroy(MenuCategory $category)
    {
        $category->delete();

        return redirect()
            ->route('admin.menu.categories.index')
            ->with('success', 'Xóa danh mục thành công.');
    }
}