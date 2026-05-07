@extends('layouts.frontend')

@section('title', $product->name . ' - 朝日形象')

@section('content')
<!-- Product Hero Section -->
@if($product->image)
<section class="position-relative mb-5" style="height: 500px; overflow: hidden;">
    <img src="{{ asset('uploads/products/thumbnail/' . $product->image) }}"
         alt="{{ $product->name }}"
         id="productHeroImage"
         class="w-100 h-100 product-hero-image"
         style="object-fit: cover; object-position: center; cursor: pointer;"
         data-bs-toggle="modal"
         data-bs-target="#imageModal"
         onerror="this.onerror=null; this.src='{{ asset('images/placeholder.svg') }}';">
    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
         style="background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.7));">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center text-white" data-aos="fade-up">
                    <h1 class="display-4 fw-bold mb-3">{{ $product->name }}</h1>
                    @if($product->price > 0)
                    <p class="lead mb-0 product-price-large">
                        NT$ {{ number_format($product->price, 0) }}
                    </p>
                    @else
                    <p class="lead mb-0">尚未定價</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Zoom Hint Icon -->
    <div class="position-absolute bottom-0 end-0 m-4">
        <div class="bg-white bg-opacity-75 rounded-circle p-3 zoom-hint">
            <i class="bi bi-zoom-in text-dark fs-4"></i>
        </div>
    </div>
</section>
@else
<section class="gradient-bg py-5 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center text-white" data-aos="fade-up">
                <h1 class="display-4 fw-bold mb-3">{{ $product->name }}</h1>
                @if($product->price > 0)
                <p class="lead mb-0 product-price-large">
                    NT$ {{ number_format($product->price, 0) }}
                </p>
                @else
                <p class="lead mb-0">尚未定價</p>
                @endif
            </div>
        </div>
    </div>
</section>
@endif

<!-- Product Content -->
<section class="mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card card-tech shadow-tech" data-aos="fade-up">
                    <div class="card-body p-5">
                        <!-- Product Image -->
                        @if($product->image)
                        <div class="text-center mb-4">
                            <img src="{{ asset('uploads/products/thumbnail/' . $product->image) }}"
                                 alt="{{ $product->name }}"
                                 id="productContentImage"
                                 class="img-fluid rounded product-detail-image"
                                 style="max-height: 500px; cursor: pointer;"
                                 data-bs-toggle="modal"
                                 data-bs-target="#imageModal"
                                 onerror="this.onerror=null; this.src='{{ asset('images/placeholder.svg') }}';">
                            <p class="text-muted small mt-2">
                                <i class="bi bi-zoom-in"></i> 點擊圖片放大查看
                            </p>
                        </div>
                        @endif

                        <!-- Product Description -->
                        @if($product->description)
                        <div class="product-description">
                            <h3 class="mb-4">商品介紹</h3>
                            <p>{{ strip_tags($product->description) }}</p>
                        </div>
                        @endif

                        <!-- Product Content -->
                        @if($product->content)
                        <div class="product-content mt-4">
                            <h3 class="mb-4">詳細內容</h3>
                            <div class="content-body">
                            {!! $product->content !!}
                            </div>
                        </div>
                        @endif

                        <!-- Product Price -->
                        <div class="mt-5 pt-4 border-top">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h4 class="mb-0">商品價格</h4>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    @if($product->price > 0)
                                    <p class="product-price-display mb-0">
                                        NT$ {{ number_format($product->price, 0) }}
                                    </p>
                                    @else
                                    <p class="product-price-display mb-0">尚未定價</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-5 pt-4 border-top">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary w-100">
                                        <i class="bi bi-arrow-left"></i> 返回商品列表
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-gradient w-100" onclick="scrollToContact()">
                                        <i class="bi bi-envelope"></i> 聯絡我們
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="imageModalLabel">{{ $product->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center bg-dark">
                @if($product->image)
                <img src="{{ asset('uploads/products/original/' . $product->image) }}"
                     alt="{{ $product->name }}"
                     class="img-fluid"
                     style="max-height: 80vh;"
                     onerror="this.onerror=null; this.src='{{ asset('images/placeholder.svg') }}';">
                @endif
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
function scrollToContact() {
    window.location.href = '{{ route('contact') }}';
}
</script>
@endsection

@push('styles')
<style>
.product-hero-image {
    transition: transform 0.3s ease;
}

.product-hero-image:hover {
    transform: scale(1.02);
}

.product-detail-image {
    border-radius: 16px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-detail-image:hover {
    transform: scale(1.02);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
}

.zoom-hint {
    transition: transform 0.3s ease, opacity 0.3s ease;
    opacity: 0.8;
}

.product-hero-image:hover + div .zoom-hint,
.zoom-hint:hover {
    transform: scale(1.1);
    opacity: 1;
}

.product-price-large {
    font-size: 3rem;
    font-weight: bold;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.product-price-display {
    font-size: 2.5rem;
    font-weight: bold;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.product-description {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #333;
}

.product-description h3 {
    color: #667eea;
    font-weight: 600;
    margin-bottom: 1rem;
}

.product-description p {
    margin-bottom: 1rem;
}

.product-description img {
    max-width: 100%;
    height: auto;
    border-radius: 12px;
    margin: 1.5rem 0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.product-description ul,
.product-description ol {
    margin-bottom: 1rem;
    padding-left: 2rem;
}

.product-description li {
    margin-bottom: 0.5rem;
}

/* 商品內容樣式 */
.product-content {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #333;
}

.product-content h3 {
    color: #667eea;
    font-weight: 600;
    margin-bottom: 1rem;
}

.content-body {
    line-height: 1.8;
}

.content-body p {
    margin-bottom: 1rem;
}

.content-body img {
    max-width: 100%;
    height: auto;
    border-radius: 12px;
    margin: 1.5rem 0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.content-body ul,
.content-body ol {
    margin-bottom: 1rem;
    padding-left: 2rem;
}

.content-body li {
    margin-bottom: 0.5rem;
}

.content-body h1, .content-body h2, .content-body h3,
.content-body h4, .content-body h5, .content-body h6 {
    color: #667eea;
    font-weight: 600;
    margin-top: 1.5rem;
    margin-bottom: 1rem;
}

.content-body table {
    width: 100%;
    border-collapse: collapse;
    margin: 1.5rem 0;
}

.content-body th, .content-body td {
    border: 1px solid #ddd;
    padding: 0.75rem;
    text-align: left;
}

.content-body th {
    background-color: #667eea;
    color: white;
    font-weight: 600;
}

.content-body blockquote {
    border-left: 4px solid #667eea;
    padding-left: 1rem;
    margin: 1.5rem 0;
    color: #666;
    font-style: italic;
}

.content-body a {
    color: #667eea;
    text-decoration: none;
}

.content-body a:hover {
    text-decoration: underline;
}

/* Modal 樣式 */
#imageModal .modal-body {
    padding: 0;
}

#imageModal .modal-body img {
    width: 100%;
    height: auto;
}

/* 響應式調整 */
@media (max-width: 768px) {
    .product-price-large {
        font-size: 2rem;
    }

    .product-price-display {
        font-size: 2rem;
    }

    .product-hero-image {
        height: 300px !important;
    }
}

@media (max-width: 576px) {
    .product-price-large {
        font-size: 1.5rem;
    }

    .product-price-display {
        font-size: 1.5rem;
    }

    .product-description {
        font-size: 1rem;
    }
}
</style>
@endpush
