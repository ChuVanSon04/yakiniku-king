@extends('fontend.layouts.app')

@section('title', $pageTitle)

@push('styles')
    <style>
        .secret-page-hero {
            position: relative;
            overflow: hidden;
            border-radius: 1.5rem;
            background: linear-gradient(135deg, #f6eee4 0%, #fbf8f4 100%);
            border: 1px solid rgba(96, 70, 54, 0.08);
            box-shadow: 0 18px 38px rgba(36, 28, 20, 0.05);
        }

        .secret-page-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top right, rgba(185, 118, 61, 0.16), transparent 32%);
            pointer-events: none;
        }

        .secret-page-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 0.8rem;
            border-radius: 999px;
            background: rgba(18, 18, 18, 0.92);
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-size: 0.7rem;
            font-weight: 700;
        }

        .secret-page-panel {
            position: relative;
            min-height: 170px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.2rem;
            border-radius: 1.05rem;
            background: rgba(255, 255, 255, 0.82);
            border: 1px solid rgba(96, 70, 54, 0.08);
        }

        .secret-page-panel-inner {
            width: 100%;
            max-width: 300px;
            padding: 1rem 1.15rem;
            background: rgba(255, 255, 255, 0.9);
            border-left: 4px solid #b36d2b;
            border-radius: 0.8rem;
        }

        .secret-page-kicker {
            display: block;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #8f5d35;
        }

        .secret-page-text {
            margin: 0.7rem 0 0;
            line-height: 1.6;
            font-weight: 600;
            color: #2b2521;
        }
    </style>
@endpush

@section('content')
    <section class="container py-5">
        <section class="secret-page-hero p-4 p-md-5 mb-4">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <span class="secret-page-badge">Yakiniku King</span>
                    <h1 class="display-6 fw-bold mt-3 mb-3">{{ $pageTitle }}</h1>
                    <p class="lead text-muted mb-0">{{ $pageDescription }}</p>
                </div>
                <!--<div class="col-lg-5">
                    <div class="secret-page-panel">
                        <div class="secret-page-panel-inner">
                            <span class="secret-page-kicker">
                                @if ($articleType === 'recipe')
                                    {{ __('Công thức') }}
                                @else
                                    {{ __('Bí kíp') }}
                                @endif
                            </span>
                            <p class="secret-page-text">
                                @if ($articleType === 'recipe')
                                    {{ __('Tối ưu vị giác, phong cách nấu và hương vị hoàn hảo cho bữa ăn của bạn.') }}
                                @else
                                    {{ __('Mẹo hay giúp thưởng thức thịt nướng ngon hơn, chuẩn vị và dễ làm.') }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>-->
            </div>
        </section>

        <div class="row g-4">
            @forelse ($articles as $article)
                <div class="col-md-6 col-lg-4">
                    <article class="card h-100 shadow-sm">
                        @if ($article->image)
                            <img src="{{ asset('storage/' . $article->image) }}" class="card-img-top" alt="{{ localized_text($article, 'title') }}">
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h2 class="h5 card-title">{{ localized_text($article, 'title') }}</h2>
                            <p class="card-text text-muted">{{ localized_text($article, 'short_description') }}</p>
                            <button class="btn btn-dark mt-auto align-self-start" type="button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#article-modal-{{ $articleType }}-{{ $article->getKey() }}">
                                {{ __('Xem chi tiết') }}
                            </button>
                        </div>
                    </article>

                    <div class="modal fade" id="article-modal-{{ $articleType }}-{{ $article->getKey() }}"
                         tabindex="-1" aria-labelledby="article-modal-title-{{ $articleType }}-{{ $article->getKey() }}"
                         aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title fs-5" id="article-modal-title-{{ $articleType }}-{{ $article->getKey() }}">
                                        {{ localized_text($article, 'title') }}
                                    </h2>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Đóng') }}"></button>
                                </div>
                                <div class="modal-body">
                                    @if ($article->published_at)
                                        <p class="text-muted">{{ $article->published_at->format('d/m/Y') }}</p>
                                    @endif

                                    @if ($article->image)
                                        <img src="{{ asset('storage/' . $article->image) }}" class="img-fluid rounded mb-4"
                                             alt="{{ localized_text($article, 'title') }}">
                                    @endif

                                    @if (localized_text($article, 'short_description'))
                                        <p class="lead">{{ localized_text($article, 'short_description') }}</p>
                                    @endif

                                    <div>{!! nl2br(e(localized_text($article, 'content'))) !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted">{{ __('Nội dung đang được cập nhật.') }}</p>
                </div>
            @endforelse
        </div>
    </section>
@endsection