@extends('layouts.app')

@section('title', '幻燈片管理')

@section('page-title', '幻燈片管理')

@section('breadcrumb', '幻燈片管理')

@push('styles')
<style>
/* 卡片標題與按鈕垂直置中，按鈕靠右 */
.card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.card-title {
    margin-bottom: 0;
    line-height: 1;
    flex: 1;
}

.card-tools {
    margin-left: auto;
}

@media (max-width: 768px) {
    .card-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }

    .card-tools {
        margin-left: 0;
        width: 100%;
    }

    .card-tools .btn {
        width: 100%;
    }
}
</style>
@endpush

@section('content')
<!-- Main content -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">幻燈片列表</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> 新增幻燈片
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th style="width: 150px;">縮圖</th>
                            <th>標題</th>
                            <th style="width: 100px;">排序</th>
                            <th style="width: 100px;">狀態</th>
                            <th style="width: 180px;">建立日期</th>
                            <th style="width: 200px;">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sliders as $slider)
                            <tr>
                                <td>
                                    <img src="{{ asset('uploads/sliders/thumbnail/' . $slider->image) }}"
                                         alt="{{ $slider->title }}"
                                         class="img-thumbnail"
                                         style="max-width: 150px; max-height: 84px;"
                                         onerror="this.src='https://via.placeholder.com/150x84?text=No+Image'">
                                </td>
                                <td>{{ $slider->title }}</td>
                                <td>{{ $slider->sort_order }}</td>
                                <td>
                                    @if($slider->is_active)
                                        <span class="badge badge-success">啟用</span>
                                    @else
                                        <span class="badge badge-secondary">停用</span>
                                    @endif
                                </td>
                                <td>{{ $slider->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <form action="{{ route('admin.sliders.toggle', $slider) }}"
                                          method="POST"
                                          style="display: inline-block;">
                                        @csrf
                                        <button type="submit"
                                                class="btn btn-sm btn-{{ $slider->is_active ? 'warning' : 'success' }}"
                                                title="{{ $slider->is_active ? '停用' : '啟用' }}">
                                            <i class="fas fa-power-off"></i> {{ $slider->is_active ? '停用' : '啟用' }}
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.sliders.edit', $slider) }}"
                                       class="btn btn-sm btn-info"
                                       title="編輯">
                                        <i class="fas fa-pen"></i> 編輯
                                    </a>
                                    <form action="{{ route('admin.sliders.destroy', $slider) }}"
                                          method="POST"
                                          style="display: inline-block;"
                                          onsubmit="return confirm('確定要刪除此幻燈片嗎？');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-danger"
                                                title="刪除">
                                            <i class="fas fa-trash"></i> 刪除
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    <p class="text-muted my-3">暫無幻燈片資料</p>
                                    <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary">
                                        新增第一筆幻燈片
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                {{ $sliders->appends(request()->query())->links('pagination.simple') }}
            </div>
        </div>
        <!-- /.card -->
    </div>
</section>
@endsection

@push('scripts')
<script>
    // 關閉警示訊息
    $(document).ready(function() {
        $('.alert').alert();
    });
</script>
@endpush
