/**
 * AOS (Animate On Scroll) Library - JavaScript
 * 使用 CDN 連結
 * 官方文檔: https://michalsnik.github.io/aos/
 */

/* 這個檔案使用 CDN 連結，請在 frontend.blade.php 中使用以下連結: */
/* <script src="https://unpkg.com/aos@next/dist/aos.js"></script> */

/* 或者在開發環境中下載 AOS 庫到此目錄 */

// AOS 庫初始化範例：
/*
AOS.init({
    duration: 800,
    easing: 'ease-out-cubic',
    once: true,
    offset: 100,
    delay: 0
});
*/

// AOS 動畫屬性範例：
// <div data-aos="fade-up" data-aos-duration="800">內容</div>
// <div data-aos="fade-right" data-aos-delay="100">內容</div>
// <div data-aos="zoom-in" data-aos-duration="600">內容</div>

// 可用的動畫效果：
// fade-up, fade-down, fade-left, fade-right, fade-up-right, fade-up-left, fade-down-right, fade-down-left
// flip-up, flip-down, flip-left, flip-right
// slide-up, slide-down, slide-left, slide-right
// zoom-in, zoom-out
// zoom-in-up, zoom-in-down, zoom-in-left, zoom-in-right
// zoom-out-up, zoom-out-down, zoom-out-left, zoom-out-right

// 初始化設定選項：
/*
{
    offset: 120,          // 元素進入視口的偏移量 (px)
    delay: 0,             // 動畫延遲時間 (ms)
    duration: 800,        // 動畫持續時間 (ms)
    easing: 'ease',       // 動畫緩動函數
    once: false,          // 動畫是否只執行一次
    mirror: false,        // 元素離開視口時是否執行相反動畫
    anchorPlacement: 'top-bottom', // 錨點位置
    startEvent: 'DOMContentLoaded', // 初始化事件
}
*/

console.log('AOS 庫已載入，請使用 CDN 連結或下載完整版本');
