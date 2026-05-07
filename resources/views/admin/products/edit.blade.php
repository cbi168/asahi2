@extends('layouts.app')

@section('title', '編輯商品')

@section('page-title', '編輯商品')
@section('breadcrumb', '編輯商品')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">編輯商品</h3>
            </div>
                    <form action="{{ route('admin.products.update', $product) }}"
                          method="POST"
                          enctype="multipart/form-data"
                          id="productForm">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <!-- 商品名稱 -->
                            <div class="form-group">
                                <label for="name">
                                    商品名稱 <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       id="name"
                                       name="name"
                                       value="{{ old('name', $product->name) }}"
                                       placeholder="請輸入商品名稱"
                                       required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- 價格 -->
                            <div class="form-group">
                                <label for="price">
                                    價格 <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">NT$</span>
                                    </div>
                                    <input type="number"
                                           class="form-control @error('price') is-invalid @enderror"
                                           id="price"
                                           name="price"
                                           value="{{ old('price', $product->price) }}"
                                           step="0.01"
                                           min="0"
                                           placeholder="請輸入價格"
                                           required>
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <small class="form-text text-muted">支援整數或小數（最多兩位小數）</small>
                            </div>

                            <!-- 商品描述 -->
                            <div class="form-group">
                                <label for="description">商品描述</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="description"
                                          name="description"
                                          rows="3"
                                          placeholder="請輸入商品描述">{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- 商品內容 -->
                            <div class="form-group">
                                <label for="content">商品內容</label>
                                <textarea class="form-control @error('content') is-invalid @enderror"
                                          id="content"
                                          name="content"
                                          rows="10"
                                          placeholder="請輸入商品詳細內容">{{ old('content', $product->content) }}</textarea>
                                @error('content')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- 目前圖片 -->
                            @if($product->image)
                                <div class="form-group">
                                    <label>目前圖片</label>
                                    <div>
                                        <img src="{{ asset('uploads/products/thumbnail/' . $product->image) }}"
                                             alt="{{ $product->name }}"
                                             class="img-thumbnail"
                                             style="max-width: 200px; max-height: 200px;">
                                        <p class="text-muted small mt-1">
                                            原圖：<a href="{{ asset('uploads/products/original/' . $product->image) }}"
                                                   target="_blank">查看</a>
                                        </p>
                                    </div>
                                </div>
                            @endif

                            <!-- 更換圖片 -->
                            <div class="form-group">
                                <label for="image">更換圖片</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file"
                                               class="custom-file-input @error('image') is-invalid @enderror"
                                               id="image"
                                               name="image"
                                               accept="image/jpeg,image/jpg,image/png,image/webp">
                                        <label class="custom-file-label" for="image">
                                            選擇新圖片...
                                        </label>
                                    </div>
                                </div>
                                @error('image')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">
                                    建議尺寸：正方形（最小 600x600）<br>
                                    檔案格式：JPG、JPEG、PNG、WEBP（最大 5MB）<br>
                                    <span class="text-warning">若不更換圖片，請勿選擇新檔案</span>
                                </small>
                            </div>

                            <!-- 新圖片預覽 -->
                            <div class="form-group" id="imagePreviewContainer" style="display: none;">
                                <label>新圖片預覽</label>
                                <div>
                                    <img id="imagePreview"
                                         src=""
                                         alt="圖片預覽"
                                         class="img-thumbnail"
                                         style="max-width: 200px; max-height: 200px;">
                                </div>
                            </div>

                            <!-- 排序 -->
                            <div class="form-group">
                                <label for="sort_order">排序</label>
                                <input type="number"
                                       class="form-control @error('sort_order') is-invalid @enderror"
                                       id="sort_order"
                                       name="sort_order"
                                       value="{{ old('sort_order', $product->sort_order) }}"
                                       min="0"
                                       placeholder="數字越大越排在前面">
                                @error('sort_order')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">數字越大越排在前面（預設：0）</small>
                            </div>

                            <!-- 啟用狀態 -->
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox"
                                           class="custom-control-input"
                                           id="is_active"
                                           name="is_active"
                                           value="1"
                                           {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="is_active">
                                        啟用商品
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="card-footer" style="position: relative; z-index: 1;">
                        <button type="submit" form="productForm" class="btn btn-warning">
                            <i class="fas fa-save"></i> 更新
                        </button>
                        <button type="button"
                                class="btn btn-secondary"
                                id="cancelButton"
                                style="position: relative; z-index: 9999; pointer-events: auto !important; cursor: pointer;">
                            <i class="fas fa-times"></i> 取消
                        </button>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<!-- TinyMCE V5 編輯器（本地檔案，無需 API Key） -->
<script src="{{ asset('assets/plugins/tinymce/tinymce.min.js') }}"></script>
<script>
    // 取消按鈕 - 使用 mousedown 事件來導航
    document.addEventListener('DOMContentLoaded', function() {
        const cancelBtn = document.getElementById('cancelButton');
        if (cancelBtn) {
            console.log('Cancel button initialized');

            // 在 mousedown 時執行導航（因為 click 事件被阻止了）
            cancelBtn.addEventListener('mousedown', function(e) {
                console.log('Cancel button mousedown - navigating away...');

                // 延遲一點執行，避免與當前事件衝突
                setTimeout(function() {
                    console.log('Navigating to: {{ route('admin.products.index') }}');
                    window.location.href = '{{ route('admin.products.index') }}';
                }, 10);

                e.preventDefault();
                e.stopPropagation();
                return false;
            }, true);
        }
    });

    // 初始化 TinyMCE 編輯器（中文介面）
    tinymce.init({
        selector: '#content',
        height: 400,
        language: 'zh_TW',
        menubar: false,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'table', 'help', 'wordcount'
        ],
        toolbar:
            'undo redo | blocks | bold italic underline strikethrough | \
            alignleft aligncenter alignright alignjustify | \
            bullist numlist outdent indent | forecolor backcolor | \
            link table | removeformat code help',
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; font-size: 14px }',
        branding: false,
        promotion: false,
        resize: true,
        elementpath: false,
        // 禁用 TinyMCE 的導航警告
        ask_before_unload: false,
        // 完全禁用需要 API Key 的功能
        automatic_uploads: false,
        images_upload_url: null,
        paste_data_images: false
    });

    // 圖片預覽功能
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const previewContainer = document.getElementById('imagePreviewContainer');
        const preview = document.getElementById('imagePreview');
        const label = document.querySelector('.custom-file-label');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.style.display = 'block';
                label.textContent = file.name;
            }
            reader.readAsDataURL(file);
        } else {
            previewContainer.style.display = 'none';
            label.textContent = '選擇新圖片...';
        }
    });
</script>
@endpush
