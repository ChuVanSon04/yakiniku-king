<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'title',
        'type',
        'image',
        'video_url',
        'link',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}