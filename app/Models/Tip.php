<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tip extends Model
{
    protected $fillable = [
        'title',
        'title_en',
        'slug',
        'short_description',
        'short_description_en',
        'content',
        'content_en',
        'image',
        'status',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
            'published_at' => 'datetime',
        ];
    }
}
