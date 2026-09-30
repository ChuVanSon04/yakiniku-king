@extends('fontend.layouts.app')

@section('title', $pageTitle)

@section('content')
    <article class="container py-5">
        <a class="text-danger text-decoration-none" href="{{ url()->previous() }}">&larr; Quay lại</a>

        <div class="mt-4" style="max-width: 850px;">
            <h1>{{ $article->title }}</h1>

            @if ($article->published_at)
                <p class="text-muted">{{ $article->published_at->format('d/m/Y') }}</p>
            @endif

            @if ($article->image)
                <img src="{{ asset('storage/' . $article->image) }}" class="img-fluid rounded mb-4" alt="{{ $article->title }}">
            @endif

            @if ($article->short_description)
                <p class="lead">{{ $article->short_description }}</p>
            @endif

            <div>{!! nl2br(e($article->content)) !!}</div>
        </div>
    </article>
@endsection