@extends('layouts.app')

@section('title', '影片管理')

@section('page-title', '影片管理')

@section('breadcrumb', '影片管理')

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

/* 縮圖樣式 */
.video-thumbnail {
    display: inline-block;
    text-decoration: none;
    transition: transform 0.2s ease-in-out;
}

.video-thumbnail:hover {
    transform: scale(1.05);
}

.video-thumbnail img {
    border-radius: 0.5rem;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

/* Modal RWD 調整 */
@media (max-width: 992px) {
    .modal-dialog {
        max-width: 90%;
        margin: 1rem auto;
    }
}

@media (max-width: 768px) {
    .modal-dialog {
        max-width: 95%;
        margin: 0.5rem;
    }

    .modal-body {
        padding: 0.5rem;
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

    /* 在手機版隱藏一些較不重要的欄位 */
    .table th:nth-child(4),
    .table td:nth-child(4),
    .table th:nth-child(5),
    .table td:nth-child(5) {
        display: none;
    }

    .video-thumbnail img {
        width: 80px !important;
        height: 45px !important;
    }

    .btn-group {
        flex-direction: column;
        width: 100%;
    }

    .btn-group .btn {
        width: 100%;
        margin-bottom: 0.5rem;
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
                <h3 class="card-title">影片列表</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.videos.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> 新增影片
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
                                        <th>影片 ID</th>
                                        <th style="width: 100px;">排序</th>
                                        <th style="width: 100px;">狀態</th>
                                        <th style="width: 150px;">建立日期</th>
                                        <th style="width: 150px;" class="text-center">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($videos as $video)
                                    <tr>
                                        <td>
                                            <a href="#" class="video-thumbnail" data-video-id="{{ $video->video_id }}" title="點擊預覽影片">
                                                <img src="{{ $video->thumbnail }}"
                                                     alt="{{ $video->title }}"
                                                     class="img-thumbnail"
                                                     style="width: 120px; height: 68px; object-fit: cover; cursor: pointer;">
                                            </a>
                                            <small class="form-text text-muted d-block mt-1">
                                                <i class="fas fa-play-circle"></i> 點擊預覽
                                            </small>
                                        </td>
                                        <td>{{ $video->title }}</td>
                                        <td><code>{{ $video->video_id }}</code></td>
                                        <td>{{ $video->sort_order }}</td>
                                        <td>
                                            @if($video->is_active)
                                                <span class="badge badge-success">啟用</span>
                                            @else
                                                <span class="badge badge-secondary">停用</span>
                                            @endif
                                        </td>
                                        <td>{{ $video->created_at->format('Y-m-d') }}</td>
                                        <td>
                                            <form action="{{ route('admin.videos.toggle', $video) }}"
                                                  method="POST"
                                                  style="display: inline-block;">
                                                @csrf
                                                <button type="submit"
                                                        class="btn btn-sm btn-{{ $video->is_active ? 'warning' : 'success' }}"
                                                        title="{{ $video->is_active ? '停用' : '啟用' }}">
                                                    <i class="fas fa-power-off"></i> {{ $video->is_active ? '停用' : '啟用' }}
                                                </button>
                                            </form>
                                            <a href="{{ route('admin.videos.edit', $video) }}"
                                               class="btn btn-sm btn-info"
                                               title="編輯">
                                                <i class="fas fa-pen"></i> 編輯
                                            </a>
                                            <form action="{{ route('admin.videos.destroy', $video) }}"
                                                  method="POST"
                                                  style="display: inline-block;"
                                                  onsubmit="return confirm('確定要刪除此影片嗎？');">
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
                                        <td colspan="7" class="text-center">
                                            <p class="text-muted my-3">暫無影片資料</p>
                                            <a href="{{ route('admin.videos.create') }}" class="btn btn-primary">
                                                新增第一筆影片
                                            </a>
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
        </section>
</div>

<!-- YouTube 影片預覽 Modal -->
<div class="modal fade" id="videoPreviewModal" tabindex="-1" aria-labelledby="videoPreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="videoPreviewModalLabel">
                    <i class="fas fa-play-circle"></i> 影片預覽
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="ratio ratio-16x9">
                    <iframe id="youtubeFrame"
                            src=""
                            allow="autoplay; fullscreen"
                            allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// YouTube 影片預覽
$(document).ready(function() {
    // 檢查 Modal 是否存在
    if ($('#videoPreviewModal').length === 0) {
        console.error('找不到影片預覽 Modal');
        return;
    }

    // 綁定縮圖點擊事件
    $(document).on('click', '.video-thumbnail', function(e) {
        e.preventDefault();

        const videoId = $(this).data('video-id');

        if (!videoId) {
            alert('無法取得影片 ID');
            return;
        }

        // 設定 iframe 來源並顯示 Modal
        const embedUrl = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0`;
        $('#youtubeFrame').attr('src', embedUrl);

        // 使用 Bootstrap 5 的語法
        const myModal = new bootstrap.Modal(document.getElementById('videoPreviewModal'));
        myModal.show();
    });

    // 當 Modal 關閉時清除 iframe 來源
    $('#videoPreviewModal').on('hidden.bs.modal', function() {
        $('#youtubeFrame').attr('src', '');
    });
});
</script>
@endsection
