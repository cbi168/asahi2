@extends('layouts.frontend')

@section('title', '關於我們 - 朝日形象網站')

@section('content')
<!-- Hero 區塊：漸層背景 -->
<section class="about-hero gradient-bg d-flex align-items-center" data-aos="fade-down">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center text-white">
                <h1 class="display-4 fw-bold mb-3">關於我們</h1>
                <p class="lead mb-0">專業、創新、值得信賴的夥伴</p>
            </div>
        </div>
    </div>
</section>

<!-- 公司介紹區塊 -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- 公司簡介卡片 -->
                <div class="card card-tech shadow-tech mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-body p-4 p-md-5">
                        <h2 class="h3 fw-bold mb-4 text-primary">
                            <i class="bi bi-building me-2"></i>公司簡介
                        </h2>
                        <div class="about-content">
                            <p class="fs-5 mb-3">
                                朝日科技有限公司成立於 2020 年，是一家專注於創新科技解決方案的新興企業。我們致力於為客戶提供最優質的產品與服務，協助企業在數位轉型的浪潮中保持領先地位。
                            </p>
                            <p class="fs-5 mb-3">
                                我們的團隊由一群充滿熱情與創意的專業人士組成，擁有豐富的產業經驗與技術實力。無論是產品開發、系統整合，還是技術諮詢，我們都能提供專業且量身打造的解決方案。
                            </p>
                            <p class="fs-5 mb-0">
                                展望未來，我們將持續創新，不斷突破，與客戶攜手共創美好未來。
                            </p>
                        </div>
                    </div>
                </div>

                <!-- 公司理念卡片 -->
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card card-tech shadow-tech h-100" data-aos="fade-up" data-aos-delay="200">
                            <div class="card-body p-4">
                                <h3 class="h4 fw-bold mb-3 text-primary">
                                    <i class="bi bi-lightbulb me-2"></i>公司願景
                                </h3>
                                <p class="mb-0">
                                    成為台灣領先的科技解決方案提供商，以創新技術驅動商業價值，為客戶創造無限可能。
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card card-tech shadow-tech h-100" data-aos="fade-up" data-aos-delay="300">
                            <div class="card-body p-4">
                                <h3 class="h4 fw-bold mb-3 text-primary">
                                    <i class="bi bi-bullseye me-2"></i>公司使命
                                </h3>
                                <p class="mb-0">
                                    提供卓越的科技產品與服務，協助客戶提升競爭力，實現數位轉型，共創雙贏。
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 核心價值觀卡片 -->
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card card-tech shadow-tech h-100" data-aos="fade-up" data-aos-delay="400">
                            <div class="card-body p-4 text-center">
                                <div class="mb-3">
                                    <i class="bi bi-award-fill text-primary" style="font-size: 3rem;"></i>
                                </div>
                                <h4 class="h5 fw-bold mb-3">專業品質</h4>
                                <p class="mb-0 small">
                                    我們堅持提供最優質的產品與服務，以專業贏得客戶信賴。
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card card-tech shadow-tech h-100" data-aos="fade-up" data-aos-delay="500">
                            <div class="card-body p-4 text-center">
                                <div class="mb-3">
                                    <i class="bi bi-lightbulb-fill text-primary" style="font-size: 3rem;"></i>
                                </div>
                                <h4 class="h5 fw-bold mb-3">創新思維</h4>
                                <p class="mb-0 small">
                                    我們不斷創新，追求突破，以新思維解決舊問題。
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card card-tech shadow-tech h-100" data-aos="fade-up" data-aos-delay="600">
                            <div class="card-body p-4 text-center">
                                <div class="mb-3">
                                    <i class="bi bi-handshake-fill text-primary" style="font-size: 3rem;"></i>
                                </div>
                                <h4 class="h5 fw-bold mb-3">誠信合作</h4>
                                <p class="mb-0 small">
                                    我們以誠待人，與客戶建立長期合作關係，共創榮景。
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA 區塊 -->
<section class="py-5 gradient-bg">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center text-white" data-aos="fade-up">
                <h2 class="h3 fw-bold mb-3">與我們合作</h2>
                <p class="lead mb-4">
                    讓我們協助您實現商業目標，創造更大價值
                </p>
                <a href="mailto:info@asahi-tech.com.tw" class="btn btn-light btn-lg px-5 rounded-pill">
                    <i class="bi bi-envelope me-2"></i>聯絡我們
                </a>
            </div>
        </div>
    </div>
</section>

<style>
.about-hero {
    min-height: 400px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.about-content p {
    line-height: 1.8;
    color: #555;
}

.card-tech:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
    transition: all 0.3s ease;
}

.about-hero .display-4 {
    font-size: 3rem;
    font-weight: 700;
}

@media (max-width: 768px) {
    .about-hero {
        min-height: 300px;
    }

    .about-hero .display-4 {
        font-size: 2rem;
    }
}
</style>
@overwrite
