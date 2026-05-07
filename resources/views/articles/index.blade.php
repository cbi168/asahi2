@extends('layouts.frontend')

@section('title', '最新消息 - 朝日形象')

@section('content')
<!-- Hero Section -->
<section class="gradient-bg py-5 mb-5">
    <div class="container py-4">
        <div class="row">
            <div class="col-12 text-center text-white" data-aos="fade-up">
                <h1 class="display-4 fw-bold mb-3">最新消息</h1>
                <p class="lead mb-0">掌握最新動態與資訊</p>
            </div>
        </div>
    </div>
</section>

<!-- Search Section -->
<section class="mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="GET" action="{{ route('articles.index') }}" class="d-flex align-items-center">
                    <input type="text" name="search" class="form-control me-2" placeholder="搜尋文章..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-gradient d-flex justify-content-center align-items-center" style="min-width: 100px; white-space: nowrap; gap: 5px;">
                        <i class="bi bi-search"></i> 搜尋
                    </button>
                    @if(request('search'))
                    <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary ms-2 d-flex justify-content-center align-items-center" style="min-width: 80px; white-space: nowrap;">清除</a>
                    @endif
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="mb-5">
    <div class="container">
        <div class="row">
            <!-- Sidebar: Categories -->
            <div class="col-lg-3 mb-4">
                <div class="card card-tech shadow-tech mb-4" data-aos="fade-right">
                    <div class="card-header bg-transparent border-0">
                        <h5 class="mb-0">
                            <i class="bi bi-folder"></i> 文章分類
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('articles.index') }}"
                               class="list-group-item list-group-item-action {{ request('category') == '' ? 'active' : '' }}">
                                全部文章
                                <span class="badge bg-primary rounded-pill float-end">{{ $articles->total() }}</span>
                            </a>
                            @foreach($categories as $category)
                            <a href="{{ route('articles.index', ['category' => $category->id]) }}"
                               class="list-group-item list-group-item-action {{ request('category') == $category->id ? 'active' : '' }}">
                                {{ $category->name }}
                                <span class="badge bg-primary rounded-pill float-end">{{ $category->articles_count }}</span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content: Articles -->
            <div class="col-lg-9">
                @if($articles->count() > 0)
                    <div class="row g-4">
                        @foreach($articles as $article)
                        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                            <div class="card card-tech h-100 shadow-tech">
                                @if($article->image)
                                <a href="{{ route('articles.show', $article->id) }}">
                                    <img src="{{ asset('uploads/articles/thumbnail/' . $article->image) }}"
                                         alt="{{ $article->title }}"
                                         class="card-img-top"
                                         style="height: 200px; object-fit: cover;">
                                </a>
                                @else
                                <a href="{{ route('articles.show', $article->id) }}">
                                    <img src="https://via.placeholder.com/400x200?text=No+Image"
                                         alt="{{ $article->title }}"
                                         class="card-img-top"
                                         style="height: 200px; object-fit: cover;">
                                </a>
                                @endif

                                <div class="card-body d-flex flex-column">
                                    @if($article->category)
                                    <div class="mb-2">
                                        <span class="badge bg-gradient rounded-pill px-3">
                                            {{ $article->category->name }}
                                        </span>
                                    </div>
                                    @endif

                                    <h5 class="card-title">
                                        <a href="{{ route('articles.show', $article->id) }}"
                                           class="text-decoration-none text-dark">
                                            {{ $article->title }}
                                        </a>
                                    </h5>

                                    <p class="card-text text-muted small">
                                        <i class="bi bi-calendar3"></i> {{ $article->publish_date->format('Y-m-d') }}
                                        <span class="ms-3">
                                            <i class="bi bi-eye"></i> {{ $article->views }}
                                        </span>
                                    </p>

                                    <p class="card-text">
                                        {!! Str::limit(strip_tags($article->content), 100) !!}
                                    </p>
                                </div>

                                <div class="card-footer bg-transparent border-0">
                                    <a href="{{ route('articles.show', $article->id) }}"
                                       class="btn btn-gradient w-100">
                                        閱讀更多
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($articles->hasPages())
                    <div class="row mt-4">
                        <div class="col-12">
                            <nav aria-label="Page navigation">
                                {{ $articles->appends(request()->query())->links() }}
                            </nav>
                        </div>
                    </div>
                    @endif
                @else
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i>
                        找不到相關文章
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
