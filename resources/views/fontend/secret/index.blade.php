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
                            <img src="{{ asset($article->image) }}" class="card-img-top" alt="{{ $article->title }}">
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h2 class="h5 card-title">{{ $article->title }}</h2>
                            <p class="card-text text-muted">{{ $article->short_description }}</p>
                            <a class="btn btn-outline-danger mt-auto align-self-start"
                               href="{{ $articleType === 'recipe' ? route('secret.recipe', $article->slug) : route('secret.tip', $article->slug) }}">
                                Xem chi tiết
                            </a>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted">Nội dung đang được cập nhật.</p>
                </div>
            @endforelse
        </div>
    </section>
@endsection