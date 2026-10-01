<?php

use App\Models\Banner;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('home hero shows active image and video banners with dot navigation', function () {
    Banner::create([
        'title' => 'Ảnh khai trương',
        'type' => 'image',
        'image' => 'banners/opening.jpg',
        'sort_order' => 1,
        'status' => true,
    ]);
    Banner::create([
        'title' => 'Video nhà hàng',
        'type' => 'video',
        'video_url' => 'https://www.youtube.com/watch?v=AbCdEfGhI12',
        'sort_order' => 2,
        'status' => true,
    ]);
    Banner::create([
        'title' => 'Video trực tiếp',
        'type' => 'video',
        'video_url' => 'https://cdn.example.com/hero.mp4',
        'sort_order' => 3,
        'status' => true,
    ]);
    Banner::create([
        'title' => 'Banner đã ẩn',
        'type' => 'image',
        'image' => 'banners/hidden.jpg',
        'sort_order' => 4,
        'status' => false,
    ]);

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('/storage/banners/opening.jpg', false)
        ->assertSee('data-video-src="https://www.youtube-nocookie.com/embed/AbCdEfGhI12?', false)
        ->assertSee('data-video-src="https://cdn.example.com/hero.mp4"', false)
        ->assertSee('data-bs-slide-to="2"', false)
        ->assertSee('aria-label="Hiển thị banner 3"', false)
        ->assertSee('data-bs-slide="prev"', false)
        ->assertSee('data-bs-slide="next"', false)
        ->assertSee('aria-label="Banner trước"', false)
        ->assertSee('aria-label="Banner tiếp theo"', false)
        ->assertDontSee('Banner đã ẩn');
});

test('home hero uses a static fallback and hides indicators without active banners', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee('src="'.asset('yakiniku-king/usina.jpg').'"', false)
        ->assertDontSee('aria-label="Điều hướng banner"', false);
});
