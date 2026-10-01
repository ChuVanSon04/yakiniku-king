<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Tip;
use Illuminate\View\View;

class SecretController extends Controller
{
    public function recipes(): View
    {
        return view('fontend.secret.index', [
            'pageTitle' => __('Công thức'),
            'pageDescription' => __('Khám phá những công thức ngon để thưởng thức cùng thịt nướng.'),
            'articles' => $this->published(Recipe::query())->get(),
            'articleType' => 'recipe',
        ]);
    }

    public function tips(): View
    {
        return view('fontend.secret.index', [
            'pageTitle' => __('Bí kíp ăn ngon'),
            'pageDescription' => __('Bí quyết thưởng thức thịt nướng trọn vị hơn.'),
            'articles' => $this->published(Tip::query())->get(),
            'articleType' => 'tip',
        ]);
    }

    public function recipe(Recipe $recipe): View
    {
        abort_if(! $this->isPublished($recipe), 404);

        return view('fontend.secret.show', [
            'article' => $recipe,
            'pageTitle' => localized_text($recipe, 'title'),
        ]);
    }

    public function tip(Tip $tip): View
    {
        abort_if(! $this->isPublished($tip), 404);

        return view('fontend.secret.show', [
            'article' => $tip,
            'pageTitle' => localized_text($tip, 'title'),
        ]);
    }

    private function published($query)
    {
        return $query
            ->where('status', true)
            ->where(function ($query): void {
                $query->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            })
            ->latest('published_at')
            ->latest('id');
    }

    private function isPublished(Recipe|Tip $article): bool
    {
        return $article->status
            && (! $article->published_at || $article->published_at->isPast());
    }
}
