@echo off
REM Laravel 開發伺服器啟動腳本
REM 適用於 UniServer 環境

REM 設置 UniServer 根目錄環境變量
REM 這讓 php_production.ini 中的 ${US_ROOTF} 能正確解析
set US_ROOTF=c:/UniServer

echo ============================================
echo Laravel 開發伺服器啟動中...
echo UniServer 根目錄: %US_ROOTF%
echo 服務器地址: http://asahi2.test
echo 按 Ctrl+C 停止伺服器
echo ============================================
echo.

REM 啟動 Laravel 開發伺服器
php artisan serve --host=asahi2.test --port=80

pause
