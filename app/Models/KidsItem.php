<?php

namespace App\Models;

use Database\Factories\KidsItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KidsItem extends Model
{
    /** @use HasFactory<KidsItemFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'name_en',
        'slug',
        'type',
        'food_category',
        'description',
        'description_en',
        'image',
        'price',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'status' => 'boolean',
    ];
}
