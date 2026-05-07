@extends('layouts.app')

@section('title', isset($articleCategory) ? '編輯分類' : '新增分類')

@section('page-title', isset($articleCategory) ? '編輯分類' : '新增分類')

@section('breadcrumb', isset($articleCategory) ? '編輯' : '新增')

@section('content')
<section class="content">
  <div class="container-fluid">
<div class="row">
    <div class="col-12">
        <div class="card {{ isset($articleCategory) ? 'card-warning' : 'card-primary' }}">
            <div class="card-header">
                <h3 class="card-title">{{ isset($articleCategory) ? '編輯分類資訊' : '填寫分類資訊' }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ isset($articleCategory) ? route('admin.article-categories.update', $articleCategory) : route('admin.article-categories.store') }}"
                  method="POST">
                @if(isset($articleCategory))
                    @method('PUT')
                @endif
                @csrf

                <div class="card-body">
                    <!-- 分類名稱 -->
                    <div class="form-group">
                        <label for="name">分類名稱 <span class="text-danger">*</span></label>
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               id="name"
                               name="name"
                               value="{{ old('name', $articleCategory->name ?? '') }}"
                               placeholder="請輸入分類名稱"
                               required
                               autofocus>
                        @error('name')
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
                               value="{{ old('sort_order', $articleCategory->sort_order ?? 0) }}"
                               min="0"
                               placeholder="數字越大越靠前">
                        <small class="form-text text-muted">數字越大，分類排序越靠前（預設：0）</small>
                        @error('sort_order')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> {{ isset($articleCategory) ? '更新分類' : '新增分類' }}
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
@endsection

@push('scripts')
<script>
    // 取消按鈕 - 使用 mousedown 事件來導航
    document.addEventListener('DOMContentLoaded', function() {
        const cancelBtn = document.getElementById('cancelButton');
        if (cancelBtn) {
            cancelBtn.addEventListener('mousedown', function(e) {
                setTimeout(function() {
                    window.location.href = '{{ route('admin.article-categories.index') }}';
                }, 10);
                e.preventDefault();
                e.stopPropagation();
                return false;
            }, true);
        }
    });
</script>
@endpush