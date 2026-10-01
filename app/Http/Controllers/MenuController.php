<?php

namespace App\Http\Controllers;

use App\Models\Combo;
use App\Models\KidsItem;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuController extends Controller
{
    private const KIDS_ITEM_TYPE_LABELS = [
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

    private const KIDS_ITEM_SORT_LABELS = [
        'featured' => 'Thứ tự mặc định',
        'name_asc' => 'Tên: A-Z',
        'name_desc' => 'Tên: Z-A',
        'price_asc' => 'Giá: thấp đến cao',
        'price_desc' => 'Giá: cao đến thấp',
    ];

    public function index(?MenuCategory $category = null): View
    {
        return $this->menuView(__('Thực đơn'), $category, function ($query) use ($category) {
            $query->when($category, function ($query) use ($category) {
                $query->where('category_id', $category->id);
            });
        });
    }

    public function mustTry(): View
    {
        return $this->menuView(__('Món nên thử'), null, function ($query) {
            $query->where('is_must_try', true);
        });
    }

    public function forKids(Request $request): View
    {
        $requestedType = $request->query('type');
        $selectedType = is_string($requestedType) && array_key_exists($requestedType, self::KIDS_ITEM_TYPE_LABELS)
            ? $requestedType
            : '';

        $requestedFoodCategory = $request->query('food_category');
        $selectedFoodCategory = is_string($requestedFoodCategory) && array_key_exists($requestedFoodCategory, self::FOOD_CATEGORY_LABELS)
            ? $requestedFoodCategory
            : '';

        $requestedSort = $request->query('sort');
        $selectedSort = is_string($requestedSort) && array_key_exists($requestedSort, self::KIDS_ITEM_SORT_LABELS)
            ? $requestedSort
            : 'featured';

        $kidsItemsQuery = KidsItem::query()
            ->where('status', true)
            ->when($selectedType !== '', fn ($query) => $query->where('type', $selectedType))
            ->when($selectedFoodCategory !== '', fn ($query) => $query->where('food_category', $selectedFoodCategory));

        match ($selectedSort) {
            'name_asc' => $kidsItemsQuery->orderBy('name'),
            'name_desc' => $kidsItemsQuery->orderByDesc('name'),
            'price_asc' => $kidsItemsQuery->orderBy('price')->orderBy('name'),
            'price_desc' => $kidsItemsQuery->orderByDesc('price')->orderBy('name'),
            default => $kidsItemsQuery
                ->orderBy('type')
                ->orderBy('food_category')
                ->orderBy('sort_order')
                ->orderBy('name'),
        };

        $kidsItems = $kidsItemsQuery->get();
        $kidsItemTypeLabels = array_map(fn (string $label): string => __($label), self::KIDS_ITEM_TYPE_LABELS);
        $foodCategoryLabels = array_map(fn (string $label): string => __($label), self::FOOD_CATEGORY_LABELS);
        $kidsItemSortLabels = array_map(fn (string $label): string => __($label), self::KIDS_ITEM_SORT_LABELS);

        return view('fontend.menu.index', [
            'pageTitle' => __('Dành cho trẻ em'),
            'menuCategories' => $this->activeCategories(),
            'menuItems' => collect(),
            'kidsItems' => $kidsItems,
            'kidsItemTypeLabels' => $kidsItemTypeLabels,
            'foodCategoryLabels' => $foodCategoryLabels,
            'kidsItemSortLabels' => $kidsItemSortLabels,
            'selectedType' => $selectedType,
            'selectedFoodCategory' => $selectedFoodCategory,
            'selectedSort' => $selectedSort,
            'combos' => collect(),
            'promotions' => collect(),
        ]);
    }

    public function combos(): View
    {
        $combos = Combo::query()
            ->where('status', true)
            ->with([
                'menuItems' => fn ($query) => $query
                    ->where('menu_items.status', true)
                    ->with('category')
                    ->orderBy('menu_items.sort_order')
                    ->orderBy('menu_items.name'),
            ])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $combos->each(function (Combo $combo): void {
            $combo->setAttribute('retail_total', $combo->menuItems->sum(
                fn (MenuItem $menuItem): float => (float) $menuItem->price * $menuItem->pivot->quantity
            ));
        });

        return view('fontend.menu.index', [
            'pageTitle' => __('Combo'),
            'menuCategories' => $this->activeCategories(),
            'menuItems' => collect(),
            'combos' => $combos,
            'promotions' => collect(),
        ]);
    }

    public function promotions(): View
    {
        return view('fontend.menu.index', [
            'pageTitle' => __('Khuyến mãi'),
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
