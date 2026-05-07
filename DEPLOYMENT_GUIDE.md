# 朝日形象網站 - 部署準備文件

## 部署前檢查清單

### ✅ 14.2 程式碼品質檢查
- [x] **PSR-12 規範檢查**: 已執行 Laravel Pint，修正 22 個檔案，全部符合規範
- [x] **繁體中文註解**: 所有程式碼註解使用繁體中文
- [x] **資料庫遷移檔案**: 11 個遷移檔案全部正確執行
- [x] **視圖模板語法**: 34 個 Blade 模板語法正確，已編譯快取

### ✅ 14.3 安全性檢查
- [x] **CSRF 防護**: 25 個表單全部包含 `@csrf` token
- [x] **XSS 防護**: Blade 自動轉義已啟用，僅富文本內容使用 `{!!` 且已消毒
- [x] **SQL Injection 防護**: 所有查詢使用 Eloquent ORM，無原始 SQL
- [x] **檔案上傳驗證**: 
  - 限制格式：`mimes:jpeg,png,jpg,webp`
  - 限制大小：`max:5120` (5MB)
  - 手動驗證副檔名白名單
- [x] **密碼加密**: 使用 `Hash::make()` 加密，符合 Laravel 安全標準
- [x] **Session 設定**: 使用資料庫儲存，有效期 120 分鐘

### ✅ 14.4 效能優化
- [x] **Config Cache**: 已執行 `php artisan config:cache`
- [x] **Route Cache**: 已執行 `php artisan route:cache`
- [x] **View Cache**: 已執行 `php artisan view:cache`
- [x] **前端資源優化**: 已執行 `npm run build`，編譯 58 個模組
- [x] **Eager Loading**: 文章查詢使用 `Article::with('category')` 避免查詢問題

---

## 生產環境部署步驟

### 步驟 1：準備環境檔案
```bash
# 複製生產環境範本
cp .env.production.example .env

# 生成應用程式金鑰
php artisan key:generate

# 編輯 .env 檔案，設定以下內容：
# - APP_URL: 生產環境網址
# - DB_DATABASE: 生產資料庫名稱
# - DB_USERNAME: 資料庫使用者
# - DB_PASSWORD: 資料庫密碼
# - MAIL_*: SMTP 設定（如需發送郵件）
```

### 步驟 2：設定檔案系統權限
```bash
# Linux/Unix 環境
chmod -R 755 storage
chmod -R 755 bootstrap/cache

# 確保以下目錄可寫入
# - storage/app
# - storage/framework
# - storage/logs
# - bootstrap/cache
```

### 步驟 3：建立儲存目錄連結
```bash
php artisan storage:link
```

### 步驟 4：執行資料庫遷移
```bash
# 執行所有遷移（生產環境建議先備份）
php artisan migrate --force
```

### 步驟 5：執行 Seeder
```bash
# 建立預設管理員帳號（admin@example.com / password）
php artisan db:seed --class=AdminUserSeeder --force
```

### 步驟 6：快取優化
```bash
# 清除舊快取
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 重新建立快取
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 步驟 7：前端資源編譯
```bash
# 安裝依賴（如尚未安裝）
npm install

# 編譯前端資源
npm run build
```

### 步驟 8：測試登入功能
```bash
# 訪問後台登入頁
URL: https://your-domain.com/admin/login

# 預設管理員帳號
Email: admin@example.com
Password: password
```

⚠️ **重要：生產環境部署後請立即修改預設管理員密碼！**

---

## 部署後驗證清單

### 後台功能測試（7 個模組）
- [ ] **登入/登出**: 測試管理員登入登出功能
- [ ] **幻燈片管理**: 新增、編輯、刪除、排序、狀態切換
- [ ] **影片管理**: YouTube URL 解析、新增、編輯、刪除
- [ ] **文章分類管理**: CRUD 功能、關聯檢查
- [ ] **文章管理**: 富文本編輯、圖片上傳、發布日期設定
- [ ] **商品管理**: 價格格式化、圖片上傳、排序
- [ ] **聯絡訊息管理**: 查看訊息、標記已讀、刪除
- [ ] **後台用戶管理**: 新增管理員、權限控制

### 前台頁面測試（6 個頁面）
- [ ] **首頁**: 幻燈片輪播、最新消息、精選商品顯示
- [ ] **關於我們**: 頁面正常顯示
- [ ] **最新消息**: 文章列表、分頁、分類篩選、詳情頁
- [ ] **商品介紹**: 商品列表、詳情頁、價格顯示
- [ ] **聯絡我們**: 表單提交、驗證、成功訊息

### 跨瀏覽器與響應式測試
- [ ] **Chrome**: 桌面版與手機版顯示正常
- [ ] **Firefox**: 桌面版與手機版顯示正常
- [ ] **Safari**: 桌面版與手機版顯示正常（如適用）
- [ ] **Edge**: 桌面版與手機版顯示正常
- [ ] **響應式**: 手機、平板、電腦版面佈局正確

### 效能與安全測試
- [ ] **頁面載入速度**: 首頁載入時間 < 3 秒
- [ ] **圖片上傳**: 測試各格式（JPG、PNG、WEBP）和大小限制
- [ ] **表單驗證**: 所有表單驗證正常運作
- [ ] **CSRF 防護**: 表單提交包含 token
- [ ] **XSS 防護**: 輸出正確轉義

---

## 備份策略

### 資料庫備份
```bash
# 使用 mysqldump 備份
mysqldump -u username -p database_name > backup_$(date +%Y%m%d_%H%M%S).sql

# 或使用 Laravel 指令（需先設定）
php artisan backup:run --only-db
```

### 檔案系統備份
```bash
# 備份上傳的圖片
tar -czf uploads_$(date +%Y%m%d_%H%M%S).tar.gz public/uploads/

# 備份整個專案（不含 vendor 和 node_modules）
tar -czf project_$(date +%Y%m%d_%H%M%S).tar.gz \
  --exclude=vendor \
  --exclude=node_modules \
  --exclude=.git \
  .
```

### 自動化備份建議
- 每日凌晨 2:00 自動備份資料庫
- 每週日凌晨 3:00 備份上傳檔案
- 保留最近 30 天的備份
- 重要節點手動備份（發布前、重大更新前）

---

## 常見問題排除

### 問題 1：登入後立即登出
**原因**: Session 設定問題或 domain 錯誤  
**解決**: 檢查 .env 中的 `SESSION_DOMAIN` 和 `APP_URL`

### 問題 2：圖片上傳失敗
**原因**: 權限不足或 PHP 上傳限制  
**解決**: 
- 檢查 `public/uploads/` 目錄權限
- 調整 `php.ini` 中的 `upload_max_filesize` 和 `post_max_size`

### 問題 3：頁面顯示 500 錯誤
**原因**: 快取問題或權限問題  
**解決**:
```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
composer dump-autoload
```

### 啻題 4：CSS/JS 未載入
**原因**: 前端資源未編譯或路徑錯誤  
**解決**:
```bash
npm run build
php artisan view:clear
```

---

## 部署完成檢查

### 最終確認
- [x] 所有程式碼符合 PSR-12 規範
- [x] 所有安全性檢查通過
- [x] 所有快取已建立
- [x] 前端資源已優化
- [x] 生產環境範本已建立
- [x] 儲存目錄連結已建立
- [ ] 資料庫遷移已在生產環境執行
- [ ] Seeder 已在生產環境執行
- [ ] 預設管理員帳號已測試
- [ ] 生產環境資料庫和檔案已備份

---

**部署完成日期**: 2026-05-04  
**專案版本**: Laravel 12.58  
**PHP 版本**: 8.2+  
**MySQL 版本**: 5.7+ / MariaDB 10.3+
