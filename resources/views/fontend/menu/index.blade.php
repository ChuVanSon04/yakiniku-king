@extends('fontend.layouts.app')

@section('title', $pageTitle)

@section('content')
    <section class="container py-5">
        <div class="mb-4">
            <h1>{{ $pageTitle }}</h1>
            <p class="text-muted">Khám phá các món ngon tại Yakiniku King.</p>
        </div>

        <div class="row g-4">
            @forelse ($menuItems as $menuItem)
                <div class="col-md-6 col-lg-4">
                    <article class="card h-100 shadow-sm">
                        @if ($menuItem->image)
                            <img src="{{ asset($menuItem->image) }}" class="card-img-top" alt="{{ $menuItem->name }}">
                        @endif

                        <div class="card-body">
                            <h2 class="h5 card-title">{{ $menuItem->name }}</h2>
                            @if ($menuItem->description)
                                <p class="card-text text-muted">{{ $menuItem->description }}</p>
                            @endif
                            <p class="fw-bold mb-0">{{ number_format($menuItem->price, 0, ',', '.') }} đ</p>
                        </div>
                    </article>
                </div>
            @empty
                @forelse ($combos as $combo)
                    <div class="col-md-6 col-lg-4">
                        <article class="card h-100 shadow-sm">
                            @if ($combo->image)
                                <img src="{{ asset($combo->image) }}" class="card-img-top" alt="{{ $combo->name }}">
                            @endif
                            <div class="card-body">
                                <h2 class="h5 card-title">{{ $combo->name }}</h2>
                                <p class="card-text text-muted">{{ $combo->description }}</p>
                                <p class="fw-bold mb-0">{{ number_format($combo->price, 0, ',', '.') }} đ</p>
                            </div>
                        </article>
                    </div>
                @empty
                    @forelse ($promotions as $promotion)
                        <div class="col-md-6 col-lg-4">
                            <article class="card h-100 shadow-sm">
                                @if ($promotion->image)
                                    <img src="{{ asset($promotion->image) }}" class="card-img-top" alt="{{ $promotion->title }}">
                                @endif
                                <div class="card-body">
                                    <h2 class="h5 card-title">{{ $promotion->title }}</h2>
                                    <p class="card-text text-muted">{{ $promotion->short_description }}</p>
                                </div>
                            </article>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-muted">Hiện chưa có dữ liệu cho mục này.</p>
                        </div>
                    @endforelse
                @endforelse
            @endforelse
        </div>
    </section>
@endsection