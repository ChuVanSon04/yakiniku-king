@extends('fontend.layouts.app')

@section('title', $pageTitle)

@section('content')
    <section class="container py-5">
        <div class="mb-4">
            <h1>{{ $pageTitle }}</h1>
            <p class="text-muted">{{ $pageDescription }}</p>
        </div>

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