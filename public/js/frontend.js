/**
 * 前台 JavaScript 功能
 * 用於處理前台頁面的互動效果和動畫
 */

$(document).ready(function() {
    // 手機版選單收合功能
    const navbarToggler = $('#navbarToggler');
    const navbarCollapse = $('.navbar-collapse');

    navbarToggler.on('click', function() {
        const isExpanded = $(this).attr('aria-expanded') === 'true';
        $(this).attr('aria-expanded', !isExpanded);
        navbarCollapse.toggleClass('show');
    });

    // 點擊選單連結後自動收合手機版選單
    $('.nav-link').on('click', function() {
        if (window.innerWidth < 992) { // Bootstrap lg 斷點
            navbarCollapse.removeClass('show');
            navbarToggler.attr('aria-expanded', 'false');
        }
    });

    // 滾動時導航列效果
    let lastScroll = 0;
    const navbar = $('.navbar-fixed-top');

    $(window).on('scroll', function() {
        const currentScroll = $(this).scrollTop();

        // 滾動超過 100px 時添加陰影效果
        if (currentScroll > 100) {
            navbar.addClass('navbar-scrolled');
        } else {
            navbar.removeClass('navbar-scrolled');
        }

        lastScroll = currentScroll;
    });

    // 平滑滾動到錨點
    $('a[href^="#"]').on('click', function(e) {
        const target = $(this.getAttribute('href'));
        if (target.length) {
            e.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 70 // 減去導航列高度
            }, 800);
        }
    });

    // 卡片懸停效果增強
    $('.card-tech').on('mouseenter', function() {
        $(this).addClass('card-hovered');
    }).on('mouseleave', function() {
        $(this).removeClass('card-hovered');
    });

    // 按鈕點擊漣漪效果
    $('.btn-gradient').on('click', function(e) {
        const button = $(this);
        const ripple = $('<span class="ripple"></span>');
        const x = e.pageX - button.offset().left;
        const y = e.pageY - button.offset().top;

        ripple.css({
            left: x + 'px',
            top: y + 'px'
        });

        button.append(ripple);

        setTimeout(function() {
            ripple.remove();
        }, 600);
    });

    // 表單輸入框焦點效果
    $('.form-control').on('focus', function() {
        $(this).parent().addClass('input-focused');
    }).on('blur', function() {
        $(this).parent().removeClass('input-focused');
    });

    // 圖片載入失敗處理
    // 使用 data 屬性標記已處理過的圖片，避免無限循環
    $('img').on('error', function() {
        const $img = $(this);
        // 檢查是否已經處理過這個圖片的錯誤
        if ($img.data('error-handled')) {
            return;
        }

        // 標記為已處理
        $img.data('error-handled', true);

        // 使用內聯 SVG 作為 placeholder，避免外部依賴
        const svgPlaceholder = 'data:image/svg+xml;base64,' + btoa(`
            <svg xmlns="http://www.w3.org/2000/svg" width="400" height="300" viewBox="0 0 400 300">
                <rect fill="#f0f0f0" width="400" height="300"/>
                <text fill="#999" font-family="Arial, sans-serif" font-size="20" x="50%" y="50%" text-anchor="middle" dy=".3em">
                    No Image
                </text>
            </svg>
        `);

        $img.attr('src', svgPlaceholder);
    });
});
