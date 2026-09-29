@extends('fontend.layouts.app')

@section('title', $pageTitle)

@push('styles')
    <style>
        .promotion-card {
            height: 100%;
            overflow: hidden;
            border: 0;
            border-radius: 4px;
            box-shadow: 0 10px 28px rgba(28, 25, 22, 0.1);
        }

        .promotion-image {
            width: 100%;
            aspect-ratio: 4 / 3;
            object-fit: cover;
            background: #f1eee9;
        }

        .promotion-image-placeholder {
            display: grid;
            place-items: center;
            color: #6c6258;
            font-weight: 600;
        }

        .promotion-card .card-body {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .promotion-card .btn {
            margin-top: auto;
        }

        .promotion-period {
            color: #6c6258;
            font-size: 0.9rem;
        }

        .promotion-detail-copy {
            white-space: pre-line;
        }

        .combo-page {
            color: #25221f;
        }

        .combo-section + .combo-section {
            margin-top: 5rem;
            padding-top: 4rem;
            border-top: 1px solid #ded9d2;
        }

        .combo-section-heading {
            margin-bottom: 2rem;
        }

        .combo-row {
            align-items: center;
            padding: 2rem 0;
            border-bottom: 1px solid #ded9d2;
        }

        .combo-row:first-child {
            padding-top: 0;
        }

        .combo-row-copy {
            padding: 1.5rem clamp(1rem, 4vw, 4rem);
        }

        .combo-row-image,
        .kids-menu-image {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .combo-row-image-wrap {
            min-height: 240px;
            aspect-ratio: 16 / 10;
            overflow: hidden;
            background: #f1eee9;
        }

        .combo-row-image-placeholder {
            display: grid;
            min-height: 240px;
            place-items: center;
            background: #f1eee9;
            color: #6c6258;
        }

        .kids-menu-copy {
            padding-right: clamp(1rem, 5vw, 5rem);
        }

        .kids-menu-gallery {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1rem;
        }

        .kids-menu-image-wrap {
            aspect-ratio: 3 / 4;
            overflow: hidden;
            background: #f1eee9;
        }

        @media (max-width: 767.98px) {
            .combo-section + .combo-section {
                margin-top: 3rem;
                padding-top: 3rem;
            }

            .combo-row-copy {
                padding: 1.5rem 0 0;
            }

            .kids-menu-copy {
                padding-right: 0;
                margin-bottom: 1.5rem;
            }

            .kids-menu-gallery {
                gap: 0.65rem;
            }
        }
    </style>
@endpush

@section('content')
    <section class="container py-5">
        <div class="mb-4">
            <h1>{{ $pageTitle }}</h1>
            <p class="text-muted">
                @if (request()->routeIs('menu.promotions'))
                    Khám phá những ưu đãi đang diễn ra tại Yakiniku King.
                @elseif (request()->routeIs('menu.combos'))
                    Những lựa chọn dành cho bữa ăn cùng gia đình và các thực khách nhí.
                @else
                    Khám phá các món ngon tại Yakiniku King.
                @endif
            </p>
        </div>

        @if (request()->routeIs('menu.promotions'))
            <div class="row g-4">
                @forelse ($promotions as $promotion)
                    <div class="col-12 col-md-6 col-lg-4">
                        <article class="card promotion-card">
                            @if ($promotion->image)
                                <img src="{{ asset($promotion->image) }}" class="promotion-image" alt="{{ $promotion->title }}" loading="lazy">
                            @else
                                <div class="promotion-image promotion-image-placeholder" aria-hidden="true">Ưu đãi đặc biệt</div>
                            @endif

                            <div class="card-body p-4">
                                <h2 class="h5 card-title">{{ $promotion->title }}</h2>
                                <p class="card-text text-muted">{{ $promotion->short_description }}</p>
                                <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#promotion-detail-{{ $loop->index }}">
                                    Xem chi tiết
                                </button>
                            </div>
                        </article>
                    </div>

                    <div class="modal fade" id="promotion-detail-{{ $loop->index }}" tabindex="-1" aria-labelledby="promotion-detail-title-{{ $loop->index }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title h5" id="promotion-detail-title-{{ $loop->index }}">{{ $promotion->title }}</h2>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="promotion-detail-copy mb-3">{{ $promotion->description ?: $promotion->short_description }}</p>
                                    @if ($promotion->start_date || $promotion->end_date)
                                        <p class="promotion-period mb-0">
                                            Thời gian áp dụng:
                                            {{ $promotion->start_date?->format('d/m/Y') ?? 'N/A' }}
                                            -
                                            {{ $promotion->end_date?->format('d/m/Y') ?? 'N/A' }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted">Hiện chưa có chương trình khuyến mãi nào.</p>
                    </div>
                @endforelse
            </div>
        @elseif (request()->routeIs('menu.combos'))
            <div class="combo-page">
                <section class="combo-section" aria-labelledby="combo-list-title">
                    

                    @forelse ($combos as $combo)
                        <article class="row combo-row g-4">
                            <div class="col-md-6">
                                <div class="combo-row-copy">
                                    <h3 class="h4">{{ $combo->name }}</h3>
                                    @if ($combo->description)
                                        <p class="text-muted">{{ $combo->description }}</p>
                                    @endif
                                    <p class="fw-bold fs-5 mb-0">{{ number_format($combo->price, 0, ',', '.') }} đ</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if ($combo->image)
                                    <div class="combo-row-image-wrap">
                                        <img src="{{ asset($combo->image) }}" class="combo-row-image" alt="Combo {{ $combo->name }}" loading="lazy">
                                    </div>
                                @else
                                    <div class="combo-row-image-placeholder">{{ $combo->name }}</div>
                                @endif
                            </div>
                        </article>
                    @empty
                        <p class="text-muted">Hiện chưa có combo nào.</p>
                    @endforelse
                </section>

                <section class="combo-section" aria-labelledby="kids-menu-title">
                    <div class="row align-items-center g-4">
                        <div class="col-md-5">
                            <div class="kids-menu-copy">
                                <p class="text-uppercase fw-bold small mb-2">Dành cho thực khách nhí</p>
                                <h2 class="h3 mb-3" id="kids-menu-title">Kids Menu</h2>
                                <p class="text-muted">
                                    Khám phá thực đơn riêng cho các bé với những lựa chọn hấp dẫn, để cả gia đình cùng tận hưởng bữa ăn tại Yakiniku King.
                                </p>
                                <a class="btn btn-dark" href="{{ route('menu.for-kids') }}">Khám phá Kids Menu</a>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="kids-menu-gallery">
                                <div class="kids-menu-image-wrap">
                                    <img src="{{ asset('yakiniku-king/for-kid.jpg') }}" class="kids-menu-image" alt="Món ăn trong Kids Menu" loading="lazy">
                                </div>
                                <div class="kids-menu-image-wrap">
                                    <img src="{{ asset('yakiniku-king/service_img_kidsmenu.jpg') }}" class="kids-menu-image" alt="Không gian phục vụ Kids Menu" loading="lazy">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        @else
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
                        <div class="col-12">
                            <p class="text-muted">Hiện chưa có dữ liệu cho mục này.</p>
                        </div>
                    @endforelse
                @endforelse
            </div>
        @endif
    </section>
@endsection