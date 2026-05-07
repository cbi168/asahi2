@extends('layouts.frontend')

@section('title', '前台測試頁面 - 朝日形象網站')

@section('content')
<!-- Hero 區塊 -->
<section class="gradient-hero py-5 mb-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="text-white mb-4" data-aos="fade-up">
                    朝日科技形象網站
                </h1>
                <p class="text-white-50 fs-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                    科技創新風格前台佈局測試頁面
                </p>
                <button class="btn btn-gradient btn-lg" data-aos="fade-up" data-aos-delay="200">
                    <i class="bi bi-lightning-charge me-2"></i>開始體驗
                </button>
            </div>
        </div>
    </div>
</section>

<!-- 漸層背景測試 -->
<section class="py-5 mb-5">
    <div class="container">
        <div class="gradient-bg rounded-tech p-5 text-white text-center" data-aos="fade-up">
            <h2 class="mb-3">漸層背景測試</h2>
            <p class="mb-0">這是使用 gradient-bg 類別的漸層背景效果</p>
        </div>
    </div>
</section>

<!-- 科技創新風格卡片測試 -->
<section class="py-5 mb-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5" data-aos="fade-up">科技創新風格組件測試</h2>

        <div class="row g-4">
            <!-- 卡片 1 -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="0">
                <div class="card-tech h-100">
                    <div class="card-body">
                        <div class="text-primary mb-3">
                            <i class="bi bi-palette fs-1"></i>
                        </div>
                        <h5 class="card-title">科技創新風格</h5>
                        <p class="card-text">
                            使用漸層色彩、圓角卡片、陰影效果打造現代化視覺體驗。
                        </p>
                        <button class="btn btn-gradient">查看詳情</button>
                    </div>
                </div>
            </div>

            <!-- 卡片 2 -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card-tech h-100">
                    <div class="card-body">
                        <div class="text-primary mb-3">
                            <i class="bi bi-phone fs-1"></i>
                        </div>
                        <h5 class="card-title">響應式設計</h5>
                        <p class="card-text">
                            完美支援手機、平板、電腦等多種裝置，提供一致的使用者體驗。
                        </p>
                        <button class="btn btn-gradient-secondary">查看詳情</button>
                    </div>
                </div>
            </div>

            <!-- 卡片 3 -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card-tech h-100">
                    <div class="card-body">
                        <div class="text-primary mb-3">
                            <i class="bi bi-magic fs-1"></i>
                        </div>
                        <h5 class="card-title">動態效果</h5>
                        <p class="card-text">
                            AOS 滾動動畫、按鈕漣漪效果、卡片懸停提升等豐富互動體驗。
                        </p>
                        <button class="btn btn-gradient-accent">查看詳情</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 陰影效果測試 -->
<section class="py-5 mb-5">
    <div class="container">
        <h2 class="text-center mb-5" data-aos="fade-up">陰影深度測試</h2>

        <div class="row g-4">
            <div class="col-lg-3 col-md-6" data-aos="fade-up">
                <div class="card-tech shadow-sm p-4 text-center">
                    <h5>Shadow SM</h5>
                    <p class="text-muted mb-0">小陰影效果</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card-tech shadow-md p-4 text-center">
                    <h5>Shadow MD</h5>
                    <p class="text-muted mb-0">中等陰影效果</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card-tech shadow-lg p-4 text-center">
                    <h5>Shadow LG</h5>
                    <p class="text-muted mb-0">大陰影效果</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card-tech shadow-tech p-4 text-center">
                    <h5>Shadow Tech</h5>
                    <p class="text-muted mb-0">科技風格陰影</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 按鈕測試 -->
<section class="py-5 mb-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5" data-aos="fade-up">按鈕漸層測試</h2>

        <div class="text-center">
            <button class="btn btn-gradient btn-lg me-3 mb-3" data-aos="fade-up">
                <i class="bi bi-star me-2"></i>主漸層按鈕
            </button>
            <button class="btn btn-gradient-secondary btn-lg me-3 mb-3" data-aos="fade-up" data-aos-delay="100">
                <i class="bi bi-heart me-2"></i>次要漸層按鈕
            </button>
            <button class="btn btn-gradient-accent btn-lg mb-3" data-aos="fade-up" data-aos-delay="200">
                <i class="bi bi-fire me-2"></i>強調漸層按鈕
            </button>
        </div>
    </div>
</section>

<!-- AOS 動畫測試 -->
<section class="py-5 mb-5">
    <div class="container">
        <h2 class="text-center mb-5" data-aos="fade-up">AOS 滾動動畫測試</h2>

        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up">
                <div class="card-tech p-4 text-center">
                    <h5>Fade Up</h5>
                    <p class="text-muted mb-0">從下方淡入</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-right">
                <div class="card-tech p-4 text-center">
                    <h5>Fade Right</h5>
                    <p class="text-muted mb-0">從右側淡入</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-left">
                <div class="card-tech p-4 text-center">
                    <h5>Fade Left</h5>
                    <p class="text-muted mb-0">從左側淡入</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in">
                <div class="card-tech p-4 text-center">
                    <h5>Zoom In</h5>
                    <p class="text-muted mb-0">縮放淡入</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="flip-up">
                <div class="card-tech p-4 text-center">
                    <h5>Flip Up</h5>
                    <p class="text-muted mb-0">翻轉進入</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="slide-up">
                <div class="card-tech p-4 text-center">
                    <h5>Slide Up</h5>
                    <p class="text-muted mb-0">滑入效果</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 表單測試 -->
<section class="py-5 mb-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card-tech" data-aos="fade-up">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4">表單測試</h2>
                        <form>
                            <div class="mb-3">
                                <label class="form-label">姓名</label>
                                <input type="text" class="form-control" placeholder="請輸入您的姓名">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="請輸入您的 Email">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">訊息內容</label>
                                <textarea class="form-control" rows="4" placeholder="請輸入訊息內容"></textarea>
                            </div>
                            <button type="submit" class="btn btn-gradient w-100">
                                <i class="bi bi-send me-2"></i>提交表單
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 毛玻璃效果測試 -->
<section class="py-5 mb-5 gradient-bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="glass-effect rounded-tech p-5" data-aos="fade-up">
                    <h2 class="text-center mb-4">毛玻璃效果測試</h2>
                    <p class="text-center mb-4">
                        這個區塊使用 glass-effect 類別，呈現毛玻璃透明效果
                    </p>
                    <div class="text-center">
                        <button class="btn btn-gradient">
                            <i class="bi bi-eye me-2"></i>體驗毛玻璃效果
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 測試說明 -->
<section class="py-5 mb-5">
    <div class="container">
        <div class="card-tech" data-aos="fade-up">
            <div class="card-body p-5">
                <h2 class="mb-4">📋 驗收測試檢查清單</h2>
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="mb-3">🖥️ 桌面版測試</h5>
                        <ul class="list-unstyled">
                            <li>□ 佈局正常顯示，左右間距適當</li>
                            <li>□ Navbar 導航列正常運作</li>
                            <li>□ 卡片懸停效果正常</li>
                            <li>□ 按鈕漣漪效果正常</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5 class="mb-3">📱 手機版測試</h5>
                        <ul class="list-unstyled">
                            <li>□ 佈局響應式正常</li>
                            <li>□ 手機版選單收合功能正常</li>
                            <li>□ 觸控互動正常</li>
                            <li>□ 字體大小適中易讀</li>
                        </ul>
                    </div>
                </div>
                <hr class="my-4">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="mb-3">🎨 視覺效果測試</h5>
                        <ul class="list-unstyled">
                            <li>□ 漸層色彩顯示正常</li>
                            <li>□ 圓角效果一致</li>
                            <li>□ 陰影深度適當</li>
                            <li>□ 毛玻璃效果明顯</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5 class="mb-3">✨ 動畫效果測試</h5>
                        <ul class="list-unstyled">
                            <li>□ AOS 滾動動畫流暢</li>
                            <li>□ 動畫時機適當</li>
                            <li>□ 懸停動畫自然</li>
                            <li>□ 無明顯延遲或卡頓</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
