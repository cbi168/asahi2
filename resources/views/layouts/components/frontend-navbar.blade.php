<nav class="navbar navbar-expand-lg navbar-fixed-top glass-effect">
    <div class="container">
        <!-- 品牌 Logo -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <span class="brand-text">朝日科技</span>
        </a>

        <!-- 手機版選單切換按鈕 -->
        <button class="navbar-toggler" type="button" id="navbarToggler" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- 導航選單 -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                        <i class="bi bi-house-door me-1"></i>首頁
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ url('/about') }}">
                        <i class="bi bi-info-circle me-1"></i>關於我們
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('articles*') ? 'active' : '' }}" href="{{ url('/articles') }}">
                        <i class="bi bi-newspaper me-1"></i>最新消息
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('products*') ? 'active' : '' }}" href="{{ url('/products') }}">
                        <i class="bi bi-grid me-1"></i>商品介紹
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{ url('/contact') }}">
                        <i class="bi bi-envelope me-1"></i>聯絡我們
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
