@extends('layouts.app')

@section('title', isset($video) ? '編輯影片' : '新增影片')

@section('page-title', isset($video) ? '編輯影片' : '新增影片')

@section('breadcrumb', isset($video) ? '編輯' : '新增')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ isset($video) ? '編輯影片資訊' : '填寫影片資訊' }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ isset($video) ? route('admin.videos.update', $video) : route('admin.videos.store') }}"
                              method="POST"
                              enctype="multipart/form-data">
                            @if(isset($video))
                                @method('PUT')
                            @endif
                            @csrf

                            <div class="card-body">
                                <!-- 標題 -->
                                <div class="form-group">
                                    <label for="title">影片標題 <span class="text-danger">*</span></label>
                                    <input type="text"
                                           class="form-control @error('title') is-invalid @enderror"
                                           id="title"
                                           name="title"
                                           value="{{ old('title', $video->title ?? '') }}"
                                           placeholder="請輸入影片標題"
                                           required>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- YouTube 網址 -->
                                <div class="form-group">
                                    <label for="youtube_url">YouTube 網址 <span class="text-danger">*</span></label>
                                    <input type="url"
                                           class="form-control @error('youtube_url') is-invalid @enderror"
                                           id="youtube_url"
                                           name="youtube_url"
                                           value="{{ old('youtube_url', $video->youtube_url ?? '') }}"
                                           placeholder="例如：https://www.youtube.com/watch?v=dQw4w9WgXcQ"
                                           required>
                                    <small class="form-text text-muted">
                                        支援格式：
                                        <code>https://www.youtube.com/watch?v=VIDEO_ID</code>、
                                        <code>https://youtu.be/VIDEO_ID</code>、
                                        <code>https://www.youtube.com/embed/VIDEO_ID</code>
                                    </small>
                                    @error('youtube_url')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- 排序 -->
                                <div class="form-group">
                                    <label for="sort_order">排序</label>
                                    <input type="number"
                                           class="form-control @error('sort_order') is-invalid @enderror"
                                           id="sort_order"
                                           name="sort_order"
                                           value="{{ old('sort_order', $video->sort_order ?? 0) }}"
                                           min="0"
                                           placeholder="數字越大越靠前">
                                    <small class="form-text text-muted">數字越大，影片排序越靠前（預設：0）</small>
                                    @error('sort_order')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- 狀態 -->
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox"
                                               class="custom-control-input"
                                               id="is_active"
                                               name="is_active"
                                               value="1"
                                               {{ old('is_active', isset($video) ? $video->is_active : true) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="is_active">啟用影片</label>
                                    </div>
                                </div>

                                <!-- 預覽區域 -->
                                @if(isset($video))
                                <div class="form-group">
                                    <label>目前縮圖預覽</label>
                                    <div class="text-center">
                                        <img src="{{ $video->thumbnail }}"
                                             alt="{{ $video->title }}"
                                             class="img-thumbnail"
                                             style="max-width: 400px;">
                                    </div>
                                </div>
                                @endif
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> {{ isset($video) ? '更新影片' : '新增影片' }}
                                </button>
                                <button type="button" class="btn btn-secondary" id="cancelButton" style="cursor: pointer;">
                                    <i class="fas fa-times"></i> 取消
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <script>
            // 取消按鈕 - 使用 mousedown 事件來導航
            document.addEventListener('DOMContentLoaded', function() {
                const cancelBtn = document.getElementById('cancelButton');
                if (cancelBtn) {
                    cancelBtn.addEventListener('mousedown', function(e) {
                        setTimeout(function() {
                            window.location.href = '{{ route('admin.videos.index') }}';
                        }, 10);
                        e.preventDefault();
                        e.stopPropagation();
                        return false;
                    }, true);
                }

                // 即時預覽 YouTube 縮圖
                const youtubeUrlInput = document.getElementById('youtube_url');
                const titleInput = document.getElementById('title');

                // 當 YouTube 網址輸入時，顯示提示
                youtubeUrlInput.addEventListener('input', function() {
                    const url = this.value.trim();

                    if (url.length > 10) {
                        // 這裡可以加入即時驗證或預覽功能
                        console.log('YouTube URL 輸入：', url);
                    }
                });
            });
            </script>
            @endsection
