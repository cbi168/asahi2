<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- 左側導航連結 -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">首頁</a>
        </li>
    </ul>

    <!-- 右側導航選單 -->
    <ul class="navbar-nav ml-auto">

        <!-- 訊息下拉選單 (範例) -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <!-- 訊息內容 -->
                    <div class="media">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Brad Diesel
                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Call me whenever you can...</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li>

        <!-- 通知下拉選單 (範例) -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>

        <!-- 全螢幕按鈕 -->
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

        <!-- 使用者下拉選單 -->
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                <i class="fas fa-user-circle fa-2x" style="color: #6c757d;"></i>
                <span class="d-none d-md-inline ms-2">{{ Auth::user()->name ?? 'Admin' }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow">
                <!-- 使用者資訊 -->
                <li class="dropdown-item-text d-flex align-items-center p-3">
                    <i class="fas fa-user-circle fa-3x me-2" style="color: #6c757d;"></i>
                    <div>
                        <h6 class="mb-0">{{ Auth::user()->name ?? 'Admin' }}</h6>
                        <small class="text-muted">管理員</small>
                    </div>
                </li>

                <li><hr class="dropdown-divider"></li>

                <!-- 選單項目 -->
                <li>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-user me-2"></i> 個人資料
                    </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                <!-- 登出按鈕 -->
                <li>
                    <form action="{{ route('admin.logout') }}" method="POST" class="px-3">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger w-100 text-start" style="border: none; background: none; cursor: pointer;">
                            <i class="fas fa-sign-out-alt me-2"></i> 登出
                        </button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>