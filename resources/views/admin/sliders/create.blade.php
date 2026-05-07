@extends('layouts.app')

@section('title', '新增幻燈片')

@section('page-title', '新增幻燈片')

@section('breadcrumb', '新增幻燈片')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">幻燈片資訊</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="title">標題 <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control @error('title') is-invalid @enderror"
                                       id="title"
                                       name="title"
                                       value="{{ old('title') }}"
                                       placeholder="請輸入幻燈片標題"
                                       required>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="image">圖片 <span class="text-danger">*</span></label>
                                <input type="file"
                                       class="form-control @error('image') is-invalid @enderror"
                                       id="image"
                                       name="image"
                                       accept="image/jpeg,image/jpg,image/png,image/webp"
                                       required>
                                @error('image')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @endif
                                <small class="form-text text-muted">
                                    支援格式：JPG、JPEG、PNG、WEBP（最大 5MB）<br>
                                    建議尺寸：1920x1080（16:9）
                                </small>

                                <!-- 圖片預覽區 -->
                                <div id="imagePreview" class="mt-3" style="display: none;">
                                    <img id="previewImg" src="#" alt="預覽" class="img-thumbnail" style="max-width: 100%; max-height: 300px;">
                                    <p class="mt-2 mb-0"><small id="fileName" class="text-muted"></small></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sort_order">排序</label>
                                <input type="number"
                                       class="form-control @error('sort_order') is-invalid @enderror"
                                       id="sort_order"
                                       name="sort_order"
                                       value="{{ old('sort_order', 0) }}"
                                       min="0"
                                       placeholder="數字越大越排在前面">
                                @error('sort_order')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">數字越大越排在前面，預設值為 0</small>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox"
                                           class="custom-control-input"
                                           id="is_active"
                                           name="is_active"
                                           value="1"
                                           checked>
                                    <label class="custom-control-label" for="is_active">啟用此幻燈片</label>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

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
                <!-- /.card -->
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
                    window.location.href = '{{ route('admin.sliders.index') }}';
                }, 10);
                e.preventDefault();
                e.stopPropagation();
                return false;
            }, true);
        }
    });

    $(document).ready(function() {
        // 處理圖片選擇和預覽
        $('#image').on('change', function(e) {
            var file = e.target.files[0];
            var reader = new FileReader();

            if (file) {
                // 顯示檔案名稱
                $('#fileName').text('已選擇：' + file.name);

                // 讀取並顯示圖片預覽
                reader.onload = function(e) {
                    $('#previewImg').attr('src', e.target.result);
                    $('#imagePreview').show();
                }
                reader.readAsDataURL(file);
            } else {
                $('#imagePreview').hide();
            }
        });
    });
</script>
@endpush
