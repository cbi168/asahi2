@extends('layouts.app')

@section('title', '編輯管理員')
@section('page-title', '編輯管理員')
@section('breadcrumb', '後台用戶管理 / 編輯管理員')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">編輯管理員 - {{ $adminUser->name }}</h3>
        <div class="card-tools">
          <a href="{{ route('admin.admin-users.index') }}" class="btn btn-default btn-sm">
            <i class="fas fa-arrow-left"></i> 返回列表
          </a>
        </div>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('admin.admin-users.update', $adminUser) }}">
          @csrf
          @method('PUT')

          <!-- 姓名欄位 -->
          <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="name">姓名 <span class="text-danger">*</span></label>
            <input type="text"
                   class="form-control @error('name') is-invalid @enderror"
                   id="name"
                   name="name"
                   value="{{ old('name', $adminUser->name) }}"
                   placeholder="請輸入姓名"
                   required>
            @error('name')
              <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
          </div>

          <!-- Email 欄位 -->
          <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            <label for="email">Email <span class="text-danger">*</span></label>
            <input type="email"
                   class="form-control @error('email') is-invalid @enderror"
                   id="email"
                   name="email"
                   value="{{ old('email', $adminUser->email) }}"
                   placeholder="請輸入 Email"
                   required>
            @error('email')
              <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
          </div>

          <!-- 新密碼欄位（選填） -->
          <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
            <label for="password">新密碼 <small class="text-muted">(留空則不修改)</small></label>
            <input type="password"
                   class="form-control @error('password') is-invalid @enderror"
                   id="password"
                   name="password"
                   placeholder="請輸入新密碼（至少 6 個字元）">
            @error('password')
              <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
            <small class="form-text text-muted">若要修改密碼，請輸入至少 6 個字元的新密碼</small>
          </div>

          <!-- 新密碼確認欄位 -->
          <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
            <label for="password_confirmation">確認新密碼</label>
            <input type="password"
                   class="form-control @error('password_confirmation') is-invalid @enderror"
                   id="password_confirmation"
                   name="password_confirmation"
                   placeholder="請再次輸入新密碼">
            @error('password_confirmation')
              <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
          </div>

          <!-- 提交按鈕 -->
          <div class="form-group">
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save"></i> 儲存變更
            </button>
            <button type="button" class="btn btn-default" id="cancelButton" style="cursor: pointer;">
              <i class="fas fa-times"></i> 取消
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
    // 取消按鈕 - 使用 mousedown 事件來導航
    document.addEventListener('DOMContentLoaded', function() {
        const cancelBtn = document.getElementById('cancelButton');
        if (cancelBtn) {
            cancelBtn.addEventListener('mousedown', function(e) {
                setTimeout(function() {
                    window.location.href = '{{ route('admin.admin-users.index') }}';
                }, 10);
                e.preventDefault();
                e.stopPropagation();
                return false;
            }, true);
        }
    });
</script>
@endpush
