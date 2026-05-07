<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', '朝日形象網站')</title>

    <!-- Google Fonts: Noto Sans TC (中文) + Poppins (英文) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400;500;700;900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- jQuery 3.6.0 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap 5.3 CSS -->
    @vite('resources/css/app.css')

    <!-- 前台自訂 CSS -->
    <link rel="stylesheet" href="{{ asset('css/frontend.css') }}">

    <!-- AOS 動畫庫 CSS (CDN) -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css">

    <style>
        /* 移除所有可能的浮動按鈕和箭頭 */
        .scroll-top, .btn-scroll-to-top, .back-to-top, .scroll-to-top,
        [data-toggle="scroll-to-top"], .floating-btn, .btn-floating,
        .position-fixed.btn, .fixed-bottom .btn {
            display: none !important;
            visibility: hidden !important;
            opacity: 0 !important;
        }

        /* 移除分頁組件中可能出現的箭頭 */
        .page-link::before, .page-link::after {
            content: none !important;
        }

        /* 修正前台分頁樣式 */
        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            justify-content: center;
        }

        .page-item {
            margin: 0 2px;
        }

        .page-link {
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            padding: 0.5rem 1rem;
            color: #2563EB;
            text-decoration: none;
            background-color: #fff;
            transition: all 0.2s;
        }

        .page-link:hover {
            color: #1d4ed8;
            background-color: #f3f4f6;
            border-color: #d1d5db;
        }

        .page-item.active .page-link {
            color: #fff;
            background-color: #2563EB;
            border-color: #2563EB;
        }

        .page-item.disabled .page-link {
            color: #9ca3af;
            pointer-events: none;
            background-color: #f3f4f6;
            border-color: #e5e7eb;
        }

        /* 移除分頁中的多餘符號 */
        .pagination::before,
        .pagination::after {
            display: none !important;
            content: none !important;
        }

        /* 移除空白的分頁項目 */
        .page-item:empty {
            display: none !important;
        }
    </style>

    @stack('styles')
</head>
<body class="frontend-body">

    <!-- Navbar 組件 -->
    @include('layouts.components.frontend-navbar')

    <!-- 主要內容區域 -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Footer 組件 -->
    @include('layouts.components.frontend-footer')

    <!-- Bootstrap 5.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AOS 動畫庫 JS (CDN) -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

    <!-- 前台自訂 JS -->
    <script src="{{ asset('js/frontend.js') }}"></script>

    @stack('scripts')

    <!-- 初始化 AOS 動畫 -->
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 100,
            delay: 0
        });
    </script>
</body>
</html>
