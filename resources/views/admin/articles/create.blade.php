@extends('layouts.app')

@section('title', '新增文章')
@section('page-title', '新增文章')
@section('breadcrumb', '新增文章')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">新增文章</h3>
      </div>
      <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <!-- 分類 -->
          <div class="form-group">
            <label for="category_id">分類 <span class="text-danger">*</span></label>
            <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
              <option value="">請選擇分類</option>
              @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </select>
            @error('category_id')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- 標題 -->
          <div class="form-group">
            <label for="title">標題 <span class="text-danger">*</span></label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                   value="{{ old('title') }}" required>
            @error('title')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- 內容 -->
          <div class="form-group">
            <label for="content">內容 <span class="text-danger">*</span></label>
            <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror"
                      rows="10" required>{{ old('content') }}</textarea>
            @error('content')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- 圖片 -->
          <div class="form-group">
            <label for="image">封面圖片</label>
            <input type="file" name="image" id="image" class="form-control-file @error('image') is-invalid @enderror"
                   accept="image/jpeg,image/png,image/jpg,image/webp">
            <small class="form-text text-muted">支援格式：JPG、JPEG、PNG、WEBP，最大 5MB</small>
            @error('image')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- 發布日期 -->
          <div class="form-group">
            <label for="publish_date">發布日期 <span class="text-danger">*</span></label>
            <input type="date" name="publish_date" id="publish_date"
                   class="form-control @error('publish_date') is-invalid @enderror"
                   value="{{ old('publish_date', now()->format('Y-m-d')) }}" required>
            @error('publish_date')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- 狀態 -->
          <div class="form-group">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" name="is_active" id="is_active" class="custom-control-input"
                     value="1" {{ old('is_active') ? 'checked' : '' }}>
              <label class="custom-control-label" for="is_active">立即啟用</label>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> 儲存
          </button>
          <button type="button" class="btn btn-secondary" id="cancelButton" style="cursor: pointer;">
            <i class="fas fa-times"></i> 取消
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

@push('scripts')
<!-- TinyMCE V5 編輯器（本地檔案，無需 API Key） -->
<script src="{{ asset('assets/plugins/tinymce/tinymce.min.js') }}"></script>
<script>
// 取消按鈕 - 使用 mousedown 事件來導航
document.addEventListener('DOMContentLoaded', function() {
    const cancelBtn = document.getElementById('cancelButton');
    if (cancelBtn) {
        cancelBtn.addEventListener('mousedown', function(e) {
            setTimeout(function() {
                window.location.href = '{{ route('admin.articles.index') }}';
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
</script>
@endpush
@endsection
