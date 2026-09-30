<?php

namespace App\Http\Controllers;

use App\Models\Combo;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\Promotion;
use Illuminate\View\View;

class MenuController extends Controller
{
    public function index(?MenuCategory $category = null): View
    {
        return $this->menuView('Our Menu', $category, function ($query) use ($category) {
            $query->when($category, function ($query) use ($category) {
                $query->where('category_id', $category->id);
            });
        });
    }

    public function mustTry(): View
    {
        return $this->menuView('Must Try', null, function ($query) {
            $query->where('is_must_try', true);
        });
    }

    public function forKids(): View
    {
        return $this->menuView('For Kids', null, function ($query) {
            $query->where('is_for_kids', true);
        });
    }

    public function combos(): View
    {
        return view('fontend.menu.index', [
            'pageTitle' => 'Combo',
            'menuCategories' => $this->activeCategories(),
            'menuItems' => collect(),
            'combos' => Combo::query()
                ->where('status', true)
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(),
            'promotions' => collect(),
        ]);
    }

    public function promotions(): View
    {
        return view('fontend.menu.index', [
            'pageTitle' => 'Khuyến Mãi',
            'menuCategories' => $this->activeCategories(),
            'menuItems' => collect(),
            'combos' => collect(),
            'promotions' => Promotion::query()
                ->where('status', true)
                ->latest()
                ->get(),
        ]);
    }

    private function menuView(string $pageTitle, ?MenuCategory $category, callable $filter): View
    {
        abort_if($category && ! $category->status, 404);

        $menuItems = MenuItem::query()
            ->where('status', true)
            ->tap($filter)
            ->with('category')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('fontend.menu.index', [
            'pageTitle' => $pageTitle,
            'menuCategories' => $this->activeCategories(),
            'menuItems' => $menuItems,
            'menuItemsByCategory' => $menuItems->groupBy('category_id'),
            'combos' => collect(),
            'promotions' => collect(),
        ]);
    }

    private function activeCategories()
    {
        return MenuCategory::query()
            ->where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }
}
