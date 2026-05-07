<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', '朝日形象網站 - 後台管理')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- jQuery 3.6.0 (必須在所有其他 JS 之前載入) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap 5.3 CSS (從本地引入，已在 app.css 中引入) -->
    @vite('resources/css/app.css')

    <!-- AdminLTE 3.2 CSS (CDN，可替換為本地檔案) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <!-- FontAwesome 6 Free (AdminLTE 需要) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    @stack('styles')

    <!-- 全圖樣式 -->
    <style>
        /* 移除所有內容區域的容器限制，向左延伸 */
        .content-wrapper .content-header {
            padding: 1rem 1rem 1rem 0.25rem;
        }

        .content-wrapper .content {
            padding: 0 1rem 1rem 0.25rem;
        }

        /* 讓內容區域向左延伸到底 */
        .content-wrapper .content > .container-fluid,
        .content-wrapper .content-header > .container-fluid {
            padding: 0;
            margin: 0;
            max-width: 100%;
            width: 100%;
        }

        /* 全圖內容區域 */
        .content-wrapper .content > .container-fluid > .row {
            margin: 0;
        }

        .content-wrapper .content > .container-fluid > .row > .col-12 {
            padding: 0;
        }

        /* 確保表格響應式，不超出容器 */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        .table {
            width: 100%;
        }

        /* 讓卡片使用全圖樣式 */
        .content-wrapper .content .card {
            border-radius: 0.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            margin-bottom: 1rem;
        }

        /* Alert 訊息全圖樣式 */
        .alert-dismissible {
            padding-right: 3rem;
        }

        /* RWD 調整 */
        @media (max-width: 768px) {
            .content-wrapper .content-header,
            .content-wrapper .content {
                padding: 0.5rem 0.5rem 1rem 0.5rem;
            }
        }

        /* 移除回到頂部按鈕和箭頭 */
        .btn-scroll-to-top,
        .scroll-to-top,
        .back-to-top,
        [data-toggle="scroll-to-top"],
        [data-widget="scroll-to-top"],
        .control-sidebar,
        .control-sidebar-btn,
        .btn-secondary:not(:disabled):not(.disabled).active,
        .btn-secondary:not(:disabled):not(.disabled):active,
        .show>.btn-secondary.dropdown-toggle {
            display: none !important;
            visibility: hidden !important;
            opacity: 0 !important;
        }

        /* 移除頁面右下角的所有浮動按鈕 */
        .btn-floating,
        .floating-btn,
        .fixed-bottom .btn,
        .position-fixed .btn {
            display: none !important;
        }

        /* 統一按鈕大小 */
        .btn-action {
            min-width: 32px !important;
            width: 32px !important;
            height: 32px !important;
            padding: 0 !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        /* Form 標籤按鈕樣式 */
        .btn-form {
            display: inline-block;
            margin: 0;
            padding: 0;
            border: none;
            background: none;
        }

        .btn-form button {
            margin: 0;
            border-radius: 0;
        }

        .btn-group .btn:first-child {
            border-top-left-radius: 0.25rem;
            border-bottom-left-radius: 0.25rem;
        }

        .btn-group .btn:last-child {
            border-top-right-radius: 0.25rem;
            border-bottom-right-radius: 0.25rem;
        }

        /* 修正分頁組件符號顯示問題 */
        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            flex-wrap: wrap;
        }

        .pagination li {
            display: inline-block;
        }

        .page-link {
            border: 1px solid #dee2e6;
            padding: 0.5rem 0.75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #007bff;
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #dee2e6;
        }

        .page-link:hover {
            color: #0056b3;
            text-decoration: none;
            background-color: #e9ecef;
            border-color: #dee2e6;
        }

        .page-item.active .page-link {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }

        .page-item.disabled .page-link {
            color: #6c757d;
            pointer-events: none;
            cursor: auto;
            background-color: #fff;
            border-color: #dee2e6;
        }

        /* 分頁樣式修正 */
        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            justify-content: center;
            flex-wrap: wrap;
        }

        .page-item {
            margin: 0 2px;
        }

        .page-link {
            border: 1px solid #dee2e6;
            padding: 0.5rem 0.75rem;
            color: #007bff;
            text-decoration: none;
            background-color: #fff;
            transition: all 0.2s;
        }

        .page-link:hover {
            color: #0056b3;
            background-color: #e9ecef;
            border-color: #dee2e6;
        }

        .page-item.active .page-link {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }

        .page-item.disabled .page-link {
            color: #6c757d;
            pointer-events: none;
            background-color: #fff;
            border-color: #dee2e6;
        }

        /* 卡片底部樣式 */
        .card-footer {
            background-color: #f8f9fa;
            border-top: 1px solid #dee2e6;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">

<!-- 頁面容器 -->
<div class="wrapper">

    <!-- Navbar 組件 -->
    @include('layouts.components.navbar')

    <!-- Sidebar 組件 -->
    @include('layouts.components.sidebar')

    <!-- 主內容區域 -->
    <div class="content-wrapper">

        <!-- 頂部標題列 -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>@yield('page-title', '儀表板')</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">首頁</a></li>
                            <li class="breadcrumb-item active">@yield('breadcrumb', '儀表板')</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- 主要內容 -->
        <section class="content">
            <div class="container-fluid">
                <!-- Flash 訊息 -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <h5><i class="icon fas fa-check"></i> 成功！</h5>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <h5><i class="icon fas fa-ban"></i> 錯誤！</h5>
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </section>

    </div>

    <!-- Footer 組件 -->
    @include('layouts.components.footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>

</div>

<!-- Bootstrap 5.3 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE 3.2 JS (CDN，可替換為本地檔案) -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<!-- Chart.js (用於圖表) -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

@stack('scripts')

</body>
</html>