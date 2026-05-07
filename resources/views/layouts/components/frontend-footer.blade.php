<footer class="footer">
    <div class="container">
        <div class="row">
            <!-- 公司資訊 -->
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <h5 class="footer-heading">朝日科技</h5>
                <p class="footer-text">
                    專注於創新科技解決方案，提供優質的產品與服務。
                    我們致力於為客戶創造價值，推動產業發展。
                </p>
                <div class="social-links">
                    <a href="#" class="social-link"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-link"><i class="bi bi-line"></i></a>
                    <a href="#" class="social-link"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-link"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

            <!-- 快速連結 -->
            <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                <h5 class="footer-heading">快速連結</h5>
                <ul class="footer-links">
                    <li><a href="{{ url('/') }}">首頁</a></li>
                    <li><a href="{{ url('/about') }}">關於我們</a></li>
                    <li><a href="{{ url('/articles') }}">最新消息</a></li>
                    <li><a href="{{ url('/products') }}">商品介紹</a></li>
                </ul>
            </div>

            <!-- 聯絡資訊 -->
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <h5 class="footer-heading">聯絡我們</h5>
                <ul class="footer-contact">
                    <li><i class="bi bi-geo-alt me-2"></i>台北市信義區信義路五段7號</li>
                    <li><i class="bi bi-telephone me-2"></i>(02) 1234-5678</li>
                    <li><i class="bi bi-envelope me-2"></i>info@asahi-tech.com</li>
                </ul>
            </div>

            <!-- 營業時間 -->
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-heading">營業時間</h5>
                <ul class="footer-hours">
                    <li>週一至週五：09:00 - 18:00</li>
                    <li>週六：09:00 - 12:00</li>
                    <li>週日：休息</li>
                </ul>
            </div>
        </div>

        <hr class="footer-divider">

        <!-- 版權資訊 -->
        <div class="row">
            <div class="col-12 text-center">
                <p class="copyright mb-0">
                    &copy; {{ date('Y') }} 朝日科技. All Rights Reserved.
                </p>
            </div>
        </div>
    </div>
</footer>
