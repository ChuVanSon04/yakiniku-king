<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MenuItem extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'image',
        'price',
        'is_must_try',
        'is_for_kids',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_must_try' => 'boolean',
        'is_for_kids' => 'boolean',
        'status' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(
            MenuCategory::class,
            'category_id'
        );
    }

    public function combos(): BelongsToMany
    {
    return $this->belongsToMany(
        Combo::class,
        'combo_items'
    )->withPivot('quantity');
    }
}