@extends('layouts.frontend')

@section('title', '商品介紹 - 朝日形象')

@section('content')
<!-- Hero Section -->
<section class="gradient-bg py-5 mb-5">
    <div class="container py-4">
        <div class="row">
            <div class="col-12 text-center text-white" data-aos="fade-up">
                <h1 class="display-4 fw-bold mb-3">商品介紹</h1>
                <p class="lead mb-0">探索我們的優質產品</p>
            </div>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="mb-5">
    <div class="container">
        @if($products->count() > 0)
            <div class="row g-4">
                @foreach($products as $product)
                <div class="col-12 col-md-6 col-lg-4 col-xl-3" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="card card-tech h-100 shadow-tech product-card">
                        <a href="{{ route('products.show', $product->id) }}">
                            @if($product->image)
                            <img src="{{ asset('uploads/products/thumbnail/' . $product->image) }}"
                                 alt="{{ $product->name }}"
                                 class="card-img-top product-image"
                                 style="height: 250px; object-fit: cover;"
                                 onerror="this.onerror=null; this.src='{{ asset('images/placeholder.svg') }}';">
                            @else
                            <img src="{{ asset('images/placeholder.svg') }}"
                                 alt="{{ $product->name }}"
                                 class="card-img-top product-image"
                                 style="height: 250px; object-fit: cover;">
                            @endif
                        </a>

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">
                                <a href="{{ route('products.show', $product->id) }}"
                                   class="text-decoration-none text-dark">
                                    {{ $product->name }}
                                </a>
                            </h5>

                            @if($product->description)
                            <p class="card-text flex-grow-1">
                                {{ strip_tags($product->description) }}
                            </p>
                            @endif

                            <div class="mt-auto">
                                @if($product->price > 0)
                                <p class="card-text product-price mb-0">
                                    NT$ {{ number_format($product->price, 0) }}
                                </p>
                                @else
                                <p class="card-text product-price mb-0">
                                    尚未定價
                                </p>
                                @endif
                            </div>
                        </div>

                        <div class="card-footer bg-transparent border-0">
                            <a href="{{ route('products.show', $product->id) }}"
                               class="btn btn-gradient w-100">
                                查看詳情
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
            <div class="row mt-4">
                <div class="col-12">
                    <nav aria-label="Page navigation">
                        {{ $products->appends(request()->query())->links() }}
                    </nav>
                </div>
            </div>
            @endif
        @else
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i>
                目前沒有商品
            </div>
        @endif
    </div>
</section>

<style>
.product-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15) !important;
}

.product-image {
    border-top-left-radius: 16px;
    border-top-right-radius: 16px;
    transition: transform 0.3s ease;
}

.product-card:hover .product-image {
    transform: scale(1.05);
}

.product-price {
    font-size: 1.5rem;
    font-weight: bold;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* 響應式調整 */
@media (max-width: 576px) {
    .product-image {
        height: 200px !important;
    }
}
</style>
@endsection
