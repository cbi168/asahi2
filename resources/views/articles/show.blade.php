@extends('layouts.frontend')

@section('title', $article->title . ' - 朝日形象')

@section('content')
<!-- Hero Section with Article Image -->
@if($article->image)
<section class="position-relative mb-5" style="height: 400px; overflow: hidden;">
    <img src="{{ asset('uploads/articles/thumbnail/' . $article->image) }}"
         alt="{{ $article->title }}"
         class="w-100 h-100"
         style="object-fit: cover; object-position: center;">
    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
         style="background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.7));">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center text-white" data-aos="fade-up">
                    @if($article->category)
                    <span class="badge bg-gradient rounded-pill px-3 mb-3 fs-6">
                        {{ $article->category->name }}
                    </span>
                    @endif
                    <h1 class="display-4 fw-bold mb-3">{{ $article->title }}</h1>
                    <p class="lead mb-0">
                        <i class="bi bi-calendar3"></i> {{ $article->publish_date->format('Y-m-d') }}
                        <span class="ms-3">
                            <i class="bi bi-eye"></i> {{ $article->views }} 次瀏覽
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@else
<section class="gradient-bg py-5 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center text-white" data-aos="fade-up">
                @if($article->category)
                <span class="badge bg-white text-primary rounded-pill px-3 mb-3 fs-6">
                    {{ $article->category->name }}
                </span>
                @endif
                <h1 class="display-4 fw-bold mb-3">{{ $article->title }}</h1>
                <p class="lead mb-0">
                    <i class="bi bi-calendar3"></i> {{ $article->publish_date->format('Y-m-d') }}
                    <span class="ms-3">
                        <i class="bi bi-eye"></i> {{ $article->views }} 次瀏覽
                    </span>
                </p>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Article Content -->
<section class="mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card card-tech shadow-tech" data-aos="fade-up">
                    <div class="card-body p-4">
                        <!-- Article Content -->
                        <div class="article-content">
                            {!! $article->content !!}
                        </div>

                        <!-- Share Buttons -->
                        <div class="mt-5 pt-4 border-top">
                            <h6 class="mb-3">分享這篇文章：</h6>
                            <div class="d-flex gap-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                   target="_blank"
                                   class="btn btn-outline-primary">
                                    <i class="bi bi-facebook"></i> Facebook
                                </a>
                                <a href="https://line.me/R/msg/text/?{{ urlencode($article->title . ' ' . url()->current()) }}"
                                   target="_blank"
                                   class="btn btn-outline-success">
                                    <i class="bi bi-line"></i> LINE
                                </a>
                                <a href="mailto:?subject={{ urlencode($article->title) }}&body={{ urlencode(url()->current()) }}"
                                   class="btn btn-outline-secondary">
                                    <i class="bi bi-envelope"></i> Email
                                </a>
                            </div>
                        </div>

                        <!-- Back Button -->
                        <div class="mt-4">
                            <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> 返回文章列表
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Articles -->
@if($relatedArticles->count() > 0)
<section class="mb-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-5" data-aos="fade-up">
                    <i class="bi bi-newspaper"></i> 相關文章
                </h2>
            </div>
        </div>

        <div class="row g-4">
            @foreach($relatedArticles as $related)
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                <div class="card card-tech h-100 shadow-tech">
                    @if($related->image)
                    <a href="{{ route('articles.show', $related->id) }}">
                        <img src="{{ asset('uploads/articles/thumbnail/' . $related->image) }}"
                             alt="{{ $related->title }}"
                             class="card-img-top"
                             style="height: 200px; object-fit: cover;">
                    </a>
                    @else
                    <a href="{{ route('articles.show', $related->id) }}">
                        <img src="https://via.placeholder.com/400x200?text=No+Image"
                             alt="{{ $related->title }}"
                             class="card-img-top"
                             style="height: 200px; object-fit: cover;">
                    </a>
                    @endif

                    <div class="card-body d-flex flex-column">
                        @if($related->category)
                        <div class="mb-2">
                            <span class="badge bg-gradient rounded-pill px-3">
                                {{ $related->category->name }}
                            </span>
                        </div>
                        @endif

                        <h5 class="card-title">
                            <a href="{{ route('articles.show', $related->id) }}"
                               class="text-decoration-none text-dark">
                                {{ $related->title }}
                            </a>
                        </h5>

                        <p class="card-text text-muted small">
                            <i class="bi bi-calendar3"></i> {{ $related->publish_date->format('Y-m-d') }}
                            <span class="ms-3">
                                <i class="bi bi-eye"></i> {{ $related->views }}
                            </span>
                        </p>
                    </div>

                    <div class="card-footer bg-transparent border-0">
                        <a href="{{ route('articles.show', $related->id) }}"
                           class="btn btn-gradient w-100">
                            閱讀更多
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection

@push('styles')
<style>
    .article-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #333;
    }

    .article-content h2,
    .article-content h3,
    .article-content h4 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-weight: 600;
    }

    .article-content p {
        margin-bottom: 1rem;
    }

    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        margin: 1.5rem 0;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .article-content ul,
    .article-content ol {
        margin-bottom: 1rem;
        padding-left: 2rem;
    }

    .article-content li {
        margin-bottom: 0.5rem;
    }

    .article-content blockquote {
        border-left: 4px solid #007bff;
        padding-left: 1rem;
        margin: 1.5rem 0;
        font-style: italic;
        color: #666;
    }
</style>
@endpush
