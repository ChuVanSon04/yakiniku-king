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

        .menu-category-group + .menu-category-group {
            margin-top: 4rem;
            padding-top: 3rem;
            border-top: 1px solid #ded9d2;
        }

        .menu-category-image {
            display: block;
            width: 100%;
            max-width: 360px;
            aspect-ratio: 4 / 3;
            margin-inline: auto;
            object-fit: cover;
            background: #f1eee9;
        }

        .menu-category-image-placeholder {
            display: grid;
            width: 100%;
            max-width: 360px;
            aspect-ratio: 4 / 3;
            place-items: center;
            margin-inline: auto;
            background: #f1eee9;
            color: #6c6258;
            font-weight: 600;
        }

        .menu-category-layout-reversed .menu-category-media {
            order: 2;
        }

        .menu-category-layout-reversed .menu-category-dishes {
            order: 1;
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

        .combo-modal-items {
            border-top: 1px solid #ded9d2;
        }

        .combo-modal-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid #ded9d2;
        }

        .combo-modal-item-copy {
            min-width: 0;
            flex: 1;
        }

        .combo-modal-summary {
            width: min(100%, 420px);
            margin: 1.5rem 0 0 auto;
        }

        .combo-modal-summary-row {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            padding: 0.4rem 0;
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
            .menu-category-layout-reversed .menu-category-media,
            .menu-category-layout-reversed .menu-category-dishes {
                order: initial;
            }

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
                    {{ __('Khám phá những ưu đãi đang diễn ra tại Yakiniku King.') }}
                @elseif (request()->routeIs('menu.combos'))
                    {{ __('Những lựa chọn dành cho bữa ăn cùng gia đình và các thực khách nhí.') }}
                @elseif (request()->routeIs('menu.for-kids'))
                    {{ __('Đồ ăn, dụng cụ và đồ dùng dành riêng cho các bé.') }}
                @else
                    {{ __('Khám phá các món ngon tại Yakiniku King.') }}
                @endif
            </p>
        </div>

        @if (request()->routeIs('menu.promotions'))
            <div class="row g-4">
                @forelse ($promotions as $promotion)
                    <div class="col-12 col-md-6 col-lg-4">
                        <article class="card promotion-card">
                            @if ($promotion->image)
                                <img src="{{ asset('storage/' . $promotion->image) }}" class="promotion-image" alt="{{ localized_text($promotion, 'title') }}" loading="lazy">
                            @else
                                <div class="promotion-image promotion-image-placeholder" aria-hidden="true">{{ __('Ưu đãi đặc biệt') }}</div>
                            @endif

                            <div class="card-body p-4">
                                <h2 class="h5 card-title">{{ localized_text($promotion, 'title') }}</h2>
                                <p class="card-text text-muted">{{ localized_text($promotion, 'short_description') }}</p>
                                <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#promotion-detail-{{ $loop->index }}">
                                    {{ __('Xem chi tiết') }}
                                </button>
                            </div>
                        </article>
                    </div>

                    <div class="modal fade" id="promotion-detail-{{ $loop->index }}" tabindex="-1" aria-labelledby="promotion-detail-title-{{ $loop->index }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title h5" id="promotion-detail-title-{{ $loop->index }}">{{ localized_text($promotion, 'title') }}</h2>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Đóng') }}"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="promotion-detail-copy mb-3">{{ localized_text($promotion, 'description') ?: localized_text($promotion, 'short_description') }}</p>
                                    @if ($promotion->start_date || $promotion->end_date)
                                        <p class="promotion-period mb-0">
                                            {{ __('Thời gian áp dụng:') }}
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
                        <p class="text-muted">{{ __('Hiện chưa có chương trình khuyến mãi nào.') }}</p>
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
                                    <h3 class="h4">{{ localized_text($combo, 'name') }}</h3>
                                    @if (localized_text($combo, 'description'))
                                        <p class="text-muted">{{ localized_text($combo, 'description') }}</p>
                                    @endif
                                    <p class="fw-bold fs-5 mb-0">{{ localized_price($combo->price) }}</p>
                                    <button class="btn btn-outline-dark mt-3" type="button" data-bs-toggle="modal" data-bs-target="#combo-detail-{{ $combo->id }}">
                                        {{ __('Xem chi tiết') }}
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if ($combo->image)
                                    <div class="combo-row-image-wrap">
                                        <img src="{{ asset('storage/' . $combo->image) }}" class="combo-row-image" alt="Combo {{ localized_text($combo, 'name') }}" loading="lazy">
                                    </div>
                                @else
                                    <div class="combo-row-image-placeholder">{{ localized_text($combo, 'name') }}</div>
                                @endif
                            </div>
                        </article>

                        <div class="modal fade" id="combo-detail-{{ $combo->id }}" tabindex="-1" aria-labelledby="combo-detail-title-{{ $combo->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title h5" id="combo-detail-title-{{ $combo->id }}">{{ localized_text($combo, 'name') }}</h2>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Đóng') }}"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if (localized_text($combo, 'description'))
                                            <p class="text-muted">{{ localized_text($combo, 'description') }}</p>
                                        @endif

                                        <h3 class="h6 mb-3">{{ __('Các món trong combo') }}</h3>
                                        <div class="combo-modal-items">
                                            @forelse ($combo->menuItems as $menuItem)
                                                <article class="combo-modal-item">
                                                    <div class="combo-modal-item-copy">
                                                        @if ($menuItem->category)
                                                            <p class="small text-muted mb-1">{{ localized_text($menuItem->category, 'name') }}</p>
                                                        @endif
                                                        <h4 class="h6 mb-1">{{ localized_text($menuItem, 'name') }}</h4>
                                                        @if (localized_text($menuItem, 'description'))
                                                            <p class="small text-muted mb-2">{{ localized_text($menuItem, 'description') }}</p>
                                                        @endif
                                                        <p class="small text-muted mb-0">
                                                            {{ $menuItem->pivot->quantity }} {{ app()->getLocale() === 'en' && $menuItem->pivot->quantity !== 1 ? __('các phần') : __('phần') }} × {{ localized_price($menuItem->price) }}
                                                        </p>
                                                    </div>
                                                    <strong class="text-nowrap">
                                                        {{ localized_price($menuItem->price * $menuItem->pivot->quantity) }}
                                                    </strong>
                                                </article>
                                            @empty
                                                <p class="text-muted py-3 mb-0">{{ __('Thông tin các món trong combo chưa được cập nhật.') }}</p>
                                            @endforelse
                                        </div>

                                        @if ($combo->menuItems->isNotEmpty())
                                            <div class="combo-modal-summary">
                                                <div class="combo-modal-summary-row">
                                                    <span>{{ __('Tổng giá lẻ các món') }}</span>
                                                    <span>{{ localized_price($combo->retail_total) }}</span>
                                                </div>
                                                <div class="combo-modal-summary-row border-top mt-2 pt-3">
                                                    <strong>{{ __('Giá combo') }}</strong>
                                                    <strong>{{ localized_price($combo->price) }}</strong>
                                                </div>
                                                @if ($combo->retail_total > $combo->price)
                                                    <p class="text-success text-end small mb-0">
                                                        {{ __('Tiết kiệm') }} {{ localized_price($combo->retail_total - $combo->price) }}
                                                    </p>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">{{ __('Hiện chưa có combo nào.') }}</p>
                    @endforelse
                </section>

                <section class="combo-section" aria-labelledby="kids-menu-title">
                    <div class="row align-items-center g-4">
                        <div class="col-md-5">
                            <div class="kids-menu-copy">
                                <p class="text-uppercase fw-bold small mb-2">{{ __('Dành cho thực khách nhí') }}</p>
                                <h2 class="h3 mb-3" id="kids-menu-title">{{ __('Kids Menu') }}</h2>
                                <p class="text-muted">
                                    {{ __('Khám phá thực đơn riêng cho các bé với những lựa chọn hấp dẫn, để cả gia đình cùng tận hưởng bữa ăn tại Yakiniku King.') }}
                                </p>
                                <a class="btn btn-dark" href="{{ route('menu.for-kids') }}">{{ __('Khám phá Kids Menu') }}</a>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="kids-menu-gallery">
                                <div class="kids-menu-image-wrap">
                                    <img src="{{ asset('yakiniku-king/for-kid.jpg') }}" class="kids-menu-image" alt="{{ __('Món ăn trong Kids Menu') }}" loading="lazy">
                                </div>
                                <div class="kids-menu-image-wrap">
                                    <img src="{{ asset('yakiniku-king/service_img_kidsmenu.jpg') }}" class="kids-menu-image" alt="{{ __('Không gian phục vụ Kids Menu') }}" loading="lazy">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        @elseif (request()->routeIs('menu.for-kids'))
            <form action="{{ route('menu.for-kids') }}" method="GET" class="row g-3 align-items-end mb-4">
                <div class="col-12 col-sm-6 col-lg-3">
                    <label for="kids-type" class="form-label">{{ __('Phân loại') }}</label>
                    <select id="kids-type" name="type" class="form-select">
                        <option value="">{{ __('Tất cả') }}</option>
                        @foreach ($kidsItemTypeLabels as $value => $label)
                            <option value="{{ $value }}" @selected($selectedType === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <label for="kids-food-category" class="form-label">{{ __('Nhóm món ăn') }}</label>
                    <select id="kids-food-category" name="food_category" class="form-select">
                        <option value="">{{ __('Tất cả nhóm') }}</option>
                        @foreach ($foodCategoryLabels as $value => $label)
                            <option value="{{ $value }}" @selected($selectedFoodCategory === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <label for="kids-sort" class="form-label">{{ __('Sắp xếp') }}</label>
                    <select id="kids-sort" name="sort" class="form-select">
                        @foreach ($kidsItemSortLabels as $value => $label)
                            <option value="{{ $value }}" @selected($selectedSort === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 d-flex gap-2">
                    <button class="btn btn-dark flex-grow-1" type="submit">{{ __('Lọc') }}</button>
                    @if ($selectedType || $selectedFoodCategory || $selectedSort !== 'featured')
                        <a class="btn btn-outline-secondary" href="{{ route('menu.for-kids') }}">{{ __('Xóa') }}</a>
                    @endif
                </div>
            </form>

            <div class="row g-4">
                @forelse ($kidsItems as $kidsItem)
                    <div class="col-12 col-sm-6 col-lg-4">
                        <article class="card h-100 shadow-sm">
                            @if ($kidsItem->image)
                                <img src="{{ asset('storage/' . $kidsItem->image) }}" class="card-img-top" alt="{{ localized_text($kidsItem, 'name') }}" loading="lazy">
                            @endif
                            <div class="card-body">
                                <p class="small text-muted mb-2">
                                    {{ $kidsItemTypeLabels[$kidsItem->type] ?? $kidsItem->type }}
                                    @if ($kidsItem->food_category)
                                        · {{ $foodCategoryLabels[$kidsItem->food_category] ?? $kidsItem->food_category }}
                                    @endif
                                </p>
                                <h2 class="h5 card-title">{{ localized_text($kidsItem, 'name') }}</h2>
                                @if (localized_text($kidsItem, 'description'))
                                    <p class="card-text text-muted">{{ localized_text($kidsItem, 'description') }}</p>
                                @endif
                                @if ($kidsItem->price !== null)
                                    <p class="fw-bold mb-0">{{ localized_price($kidsItem->price) }}</p>
                                @endif
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted">{{ __('Hiện chưa có nội dung dành cho trẻ em.') }}</p>
                    </div>
                @endforelse
            </div>
        @else
            @if (request()->routeIs('menu.index'))
                @forelse ($menuCategories as $menuCategory)
                    <div class="menu-category-group">
                        <h2 class="h3 mb-3">{{ localized_text($menuCategory, 'name') }}</h2>

                        <div class="row align-items-center g-4 menu-category-layout {{ $loop->even ? 'menu-category-layout-reversed' : '' }}">
                            <div class="col-12 col-md-4 menu-category-media">
                                @if ($menuCategory->image)
                                    <img
                                        src="{{ asset(str_starts_with($menuCategory->image, 'menu/') ? 'storage/' . $menuCategory->image : $menuCategory->image) }}"
                                        class="menu-category-image"
                                        alt="{{ localized_text($menuCategory, 'name') }}"
                                        loading="lazy"
                                    >
                                @else
                                    <div class="menu-category-image-placeholder" aria-hidden="true">
                                        {{ localized_text($menuCategory, 'name') }}
                                    </div>
                                @endif
                            </div>

                            <div class="col-12 col-md-8 menu-category-dishes">
                                <div class="row g-4">
                                    @forelse ($menuItemsByCategory->get($menuCategory->id, collect()) as $menuItem)
                                        <div class="col-12 col-sm-6">
                                            <article class="card h-100 shadow-sm">
                                                @if ($menuItem->image)
                                                    <img
                                                        src="{{ asset(str_starts_with($menuItem->image, 'menu/') ? 'storage/' . $menuItem->image : $menuItem->image) }}"
                                                        class="card-img-top"
                                                        alt="{{ localized_text($menuItem, 'name') }}"
                                                        loading="lazy"
                                                    >
                                                @endif

                                                <div class="card-body">
                                                    <h3 class="h5 card-title">{{ localized_text($menuItem, 'name') }}</h3>
                                                    @if (localized_text($menuItem, 'description'))
                                                        <p class="card-text text-muted">{{ localized_text($menuItem, 'description') }}</p>
                                                    @endif
                                                    <p class="fw-bold mb-0">{{ localized_price($menuItem->price) }}</p>
                                                </div>
                                            </article>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <p class="text-muted">{{ __('Danh mục này hiện chưa có món ăn.') }}</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">{{ __('Hiện chưa có danh mục thực đơn nào.') }}</p>
                @endforelse
            @else
                <div class="row g-4">
                    @forelse ($menuItems as $menuItem)
                        <div class="col-md-6 col-lg-4">
                            <article class="card h-100 shadow-sm">
                                @if ($menuItem->image)
                                    <img src="{{ asset(str_starts_with($menuItem->image, 'menu/') ? 'storage/' . $menuItem->image : $menuItem->image) }}" class="card-img-top" alt="{{ localized_text($menuItem, 'name') }}">
                                @endif

                                <div class="card-body">
                                    <h2 class="h5 card-title">{{ localized_text($menuItem, 'name') }}</h2>
                                    @if (localized_text($menuItem, 'description'))
                                        <p class="card-text text-muted">{{ localized_text($menuItem, 'description') }}</p>
                                    @endif
                                    <p class="fw-bold mb-0">{{ localized_price($menuItem->price) }}</p>
                                </div>
                            </article>
                        </div>
                    @empty
                        @forelse ($combos as $combo)
                            <div class="col-md-6 col-lg-4">
                                <article class="card h-100 shadow-sm">
                                    @if ($combo->image)
                                        <img src="{{ asset('storage/' . $combo->image) }}" class="card-img-top" alt="{{ localized_text($combo, 'name') }}">
                                    @endif
                                    <div class="card-body">
                                        <h2 class="h5 card-title">{{ localized_text($combo, 'name') }}</h2>
                                        <p class="card-text text-muted">{{ localized_text($combo, 'description') }}</p>
                                        <p class="fw-bold mb-0">{{ localized_price($combo->price) }}</p>
                                    </div>
                                </article>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-muted">{{ __('Hiện chưa có dữ liệu cho mục này.') }}</p>
                            </div>
                        @endforelse
                    @endforelse
                </div>
            @endif
        @endif
    </section>
@endsection