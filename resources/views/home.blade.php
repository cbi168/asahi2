@extends('layouts.frontend')

@section('title', '首頁 - 朝日形象網站')

@section('content')
<!-- ==================== Hero 區塊 ==================== -->
<section class="hero-section gradient-bg position-relative overflow-hidden">
    <!-- 裝飾性幾何圖案 -->
    <div class="hero-decoration">
        <div class="geometric-shape shape-1"></div>
        <div class="geometric-shape shape-2"></div>
        <div class="geometric-shape shape-3"></div>
    </div>

    <div class="container position-relative" style="z-index: 2;">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="hero-title" data-aos="fade-up" data-aos-duration="1000">
                    歡迎來到朝日形象網站
                </h1>
                <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="200">
                    我們致力於提供最優質的服務與產品
                </p>
                <div class="hero-cta" data-aos="fade-up" data-aos-delay="400">
                    <a href="{{ route('home') }}" class="btn btn-gradient btn-lg">
                        瞭解更多 <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== 幻燈片區塊 ==================== -->
@if($sliders->count() > 0)
<section class="sliders-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div id="sliderCarousel" class="carousel slide" data-bs-ride="carousel">
                    <!-- 輪播指示器 -->
                    <div class="carousel-indicators">
                        @foreach($sliders as $index => $slider)
                            <button type="button"
                                    data-bs-target="#sliderCarousel"
                                    data-bs-slide-to="{{ $index }}"
                                    class="{{ $index === 0 ? 'active' : '' }}"
                                    {{ $index === 0 ? 'aria-current="true"' : '' }}
                                    aria-label="Slide {{ $index + 1 }}">
                            </button>
                        @endforeach
                    </div>

                    <!-- 輪播內容 -->
                    <div class="carousel-inner rounded-4 shadow-tech">
                        @foreach($sliders as $index => $slider)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ asset('uploads/sliders/thumbnail/' . $slider->image) }}"
                                     class="d-block w-100"
                                     alt="{{ $slider->title }}"
                                     style="height: 450px; object-fit: cover;">
                                @if($slider->title)
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>{{ $slider->title }}</h5>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- 輪播控制按鈕 -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#sliderCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#sliderCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- ==================== 最新消息區塊 ==================== -->
@if($articles->count() > 0)
<section class="news-section py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="section-title text-center mb-5" data-aos="fade-up">
                    <i class="bi bi-newspaper text-primary"></i> 最新消息
                </h2>
            </div>
        </div>

        <div class="row g-4">
            @foreach($articles as $article)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="card card-tech h-100 border-0">
                        @if($article->image)
                            <img src="{{ asset('uploads/articles/thumbnail/' . $article->image) }}"
                                 class="card-img-top"
                                 alt="{{ $article->title }}"
                                 style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-text text-muted small">
                                <i class="bi bi-calendar3"></i> {{ $article->publish_date->format('Y-m-d') }}
                            </p>
                            <p class="card-text">
                                {{ substr(strip_tags($article->content), 0, 100) }}
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <a href="{{ route('articles.show', $article->id) }}" class="btn btn-outline-primary btn-sm w-100">
                                閱讀更多 <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- ==================== 精選商品區塊 ==================== -->
@if($products->count() > 0)
<section class="products-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="section-title text-center mb-5" data-aos="fade-up">
                    <i class="bi bi-star-fill text-warning"></i> 精選商品
                </h2>
            </div>
        </div>

        <div class="row g-4">
            @foreach($products as $product)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="card card-tech h-100 border-0">
                        @if($product->image)
                            <img src="{{ asset('uploads/products/thumbnail/' . $product->image) }}"
                                 class="card-img-top"
                                 alt="{{ $product->name }}"
                                 style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            @if($product->description)
                                <p class="card-text">
                                    {{ substr($product->description, 0, 80) }}
                                </p>
                            @endif
                            <p class="card-text fw-bold text-primary">
                                NT$ {{ number_format($product->price, 0) }}
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-gradient btn-sm w-100">
                                查看詳情 <i class="bi bi-arrow-right"></i>
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
/* Hero 區塊樣式 */
.hero-section {
    padding: 120px 0 80px;
    position: relative;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 900;
    color: #ffffff;
    margin-bottom: 1.5rem;
    animation: fadeInUp 0.8s ease-out;
}

.hero-subtitle {
    font-size: 1.5rem;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 2rem;
}

.hero-cta {
    margin-top: 2rem;
}

/* 幾何圖案裝飾 */
.hero-decoration {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: 1;
}

.geometric-shape {
    position: absolute;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 50%;
}

.shape-1 {
    width: 300px;
    height: 300px;
    top: -150px;
    right: -150px;
}

.shape-2 {
    width: 200px;
    height: 200px;
    bottom: -100px;
    left: -100px;
}

.shape-3 {
    width: 150px;
    height: 150px;
    top: 50%;
    left: 10%;
}

/* 區塊標題 */
.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1F2937;
    margin-bottom: 1rem;
}

/* 響應式調整 */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2rem;
    }

    .hero-subtitle {
        font-size: 1.2rem;
    }

    .section-title {
        font-size: 1.8rem;
    }
}

/* 動畫定義 */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
@endpush
