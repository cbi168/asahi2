@extends('layouts.app')

@section('title', '文章分類管理')

@section('page-title', '文章分類')

@section('breadcrumb', '文章分類')

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

/* 操作欄位文字往左移動20px */
.table thead th:nth-child(6) {
    padding-right: 20px;
}

/* 修正表格延伸到底部 */
.content-wrapper {
    min-height: calc(100vh - 57px);
}

section.content {
    min-height: calc(100vh - 57px - 165px);
}

.card {
    margin-bottom: 0;
}

/* 在手機版隱藏較不重要的欄位 */
@media (max-width: 768px) {
    .table th:nth-child(4),
    .table td:nth-child(4) {
        display: none;
    }

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
<section class="content">
  <div class="container-fluid">
<!-- 主要內容 -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">分類列表</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.article-categories.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> 新增分類
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                                <th style="width: 60px;">ID</th>
                                <th>分類名稱</th>
                                <th style="width: 80px;">排序</th>
                                <th style="width: 90px;">文章數量</th>
                                <th style="width: 120px;">建立日期</th>
                                <th style="width: 140px;">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->sort_order }}</td>
                                <td>
                                    <span class="badge bg-info">
                                        <i class="fas fa-newspaper"></i> 0
                                    </span>
                                </td>
                                <td>{{ $category->created_at->format('Y-m-d') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.article-categories.edit', $category) }}"
                                       class="btn btn-info btn-sm"
                                       title="編輯">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-danger btn-sm"
                                            onclick="deleteCategory({{ $category->id }})"
                                            title="刪除">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fas fa-folder-open fa-3x mb-3 d-block"></i>
                                        <p class="mb-0">尚未有分類資料</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>

<script>
// 刪除分類
function deleteCategory(categoryId) {
    if (!confirm('確定要刪除此分類嗎？此操作無法復原！')) {
        return;
    }

    fetch(`{{ route('admin.article-categories.destroy', ':id') }}`.replace(':id', categoryId), {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => {
        // 只要狀態碼是 2xx 就認為成功（Laravel redirect 也是 302，算成功）
        if (response.ok || response.status === 302 || response.status === 301) {
            alert('分類刪除成功');
            location.reload();
            return;
        }
        throw new Error('刪除失敗');
    })
    .catch(error => {
        console.error('Error:', error);
        alert('刪除失敗');
    });
}
</script>
@endsection