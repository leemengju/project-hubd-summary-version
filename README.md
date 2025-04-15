# 電商系統專案安裝指南

![PHP](https://img.shields.io/badge/PHP-8.1+-green.svg)
![Laravel](https://img.shields.io/badge/Laravel-10/11-red.svg)
![React](https://img.shields.io/badge/React-18-61dafb.svg)
![MySQL](https://img.shields.io/badge/MySQL-8.0-orange.svg)
![TailwindCSS](https://img.shields.io/badge/Tailwind-3.3-38bdf8.svg)

> 此專案包含三個子系統，展示完整電商解決方案：客戶端、商業後台前端及後端API

## 系統架構

```
客戶端(MVC架構) <─────────────┐
                            │
商業後台前端 (React + Vite) <─┼─> 商業後台API (Laravel)
                            │
                            └─> MySQL 資料庫
```

## 環境需求

- PHP 8.1+
- Node.js 16.0+ (必需，用於前端資源編譯及開發伺服器)
- MySQL 8.0+
- Composer 2.0+
- npm 7.0+ 或 yarn 1.22+

## 專案安裝步驟

### 1. 資料庫設定 (重要)

```bash
# 建立資料庫
mysql -u root -p
CREATE DATABASE your_database_name CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
use your_database_name;
source project_hubd_database.sql;
exit


```

**或使用圖形化工具**:
- 您可以使用 MySQL Workbench、phpMyAdmin 或 Sequel Pro 等工具
- 建立一個新的資料庫，命名為您喜歡的名稱，使用 utf8mb4 編碼
- 導入提供的 SQL 檔案以建立資料表結構和初始數據

### 2. 客戶端 (client-side-test)

```bash
# 進入專案目錄
cd client-side

# 安裝依賴
composer install
npm install

# 複製並設定環境變數
cp .env.example .env

# 編輯 .env 檔案，設定資料庫連線參數
# 以下為需要特別注意的設定
DB_CONNECTION=mysql
DB_HOST=127.0.0.1       # localhost 或您的資料庫主機位址
DB_PORT=3306            # MySQL 預設埠號，如有不同請修改
DB_DATABASE=your_database_name   # 您建立的資料庫名稱
DB_USERNAME=your_db_username     # 您的資料庫使用者名稱
DB_PASSWORD=your_db_password     # 您的資料庫密碼

# 生成應用程式金鑰
php artisan key:generate

# 清除快取
php artisan config:clear
php artisan cache:clear
php artisan view:clear



# 在另一個終端視窗編譯前端資源
npm run dev
```
# 開啟網頁方式
localhost\project_name\public\page_name

# 如果遇到權限問題
```
#以下為開放laravel權限問題
sudo chmod -R 777 client-side/storage
sudo chmod -R 777 client-side/bootstrap/cache

```
### 3. 商業後台前端 (business-side-frontend)

```bash
# 進入專案目錄
cd business-side-frontend

# 安裝依賴
npm install --legacy-peer-deps


# 複製並設定環境變數
cp .env.example .env


# 啟動開發伺服器
npm run dev

```

### 4. 商業後台API服務 (business-side-backend)

```bash
# 進入專案目錄
cd business-side-backend

# 安裝依賴
composer install

# 複製並設定環境變數
cp .env.example .env

# 編輯 .env 檔案，設定資料庫連線參數
# 以下為需要特別注意的設定
DB_CONNECTION=mysql
DB_HOST=127.0.0.1       # localhost 或您的資料庫主機位址
DB_PORT=3306            # MySQL 預設埠號，如有不同請修改
DB_DATABASE=your_database_name   # 您建立的資料庫名稱
DB_USERNAME=your_db_username     # 您的資料庫使用者名稱
DB_PASSWORD=your_db_password     # 您的資料庫密碼

# 設定跨域和認證相關設定
CORS_ALLOWED_ORIGINS=*


# 生成應用程式金鑰
php artisan key:generate

# 建立儲存空間符號連結 (重要：用於圖片存取)
php artisan storage:link

# 清除快取
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# 啟動API伺服器
php artisan serve --port=8000
```

## 資料庫連線故障排除

如果您在連線資料庫時遇到問題，請檢查以下幾點：

1. **確認資料庫伺服器運行中**：
   檢查服務狀態 `sudo service mysql status` 或 `sudo systemctl status mysql`

2. **驗證連線參數**：
   - 主機名稱 (DB_HOST) 正確，通常為 127.0.0.1 或 localhost
   - 埠號 (DB_PORT) 正確，MySQL 預設為 3306
   - 資料庫名稱 (DB_DATABASE) 已存在且拼寫正確
   - 使用者名稱 (DB_USERNAME) 和密碼 (DB_PASSWORD) 正確

3. **檢查使用者權限**：
   確保您使用的資料庫使用者有對該資料庫的足夠權限（SELECT, INSERT, UPDATE, DELETE, CREATE, DROP 等）。

4. **測試連線**：
   ```bash
   mysql -u your_db_username -p -h 127.0.0.1
   ```

5. **Laravel 特定問題**：
   - 確保運行了 `php artisan config:cache` 以更新任何設定變更
   - 檢查 Laravel 日誌檔案 (storage/logs/laravel.log) 中的錯誤訊息

## 資料庫結構摘要

此專案使用的資料庫包含以下主要表格：

- `users`: 使用者資訊
- `products`: 商品基本資訊
- `product_spec`: 商品規格細節
- `coupons`: 優惠券資訊
- `coupon_usages`: 優惠券使用記錄
- `campaigns`: 行銷活動設定
- `order_main`: 訂單主要資訊
- `order_detail`: 訂單明細項目

## 系統帳號

安裝完成後，您可以使用以下預設帳號登入系統：

### 測試用戶帳號
- 電子郵件: nasa0824@gmail.com
- 密碼: abc123

## 系統功能一覽

- 客戶端：商品瀏覽、購物車、結帳流程、優惠券應用
- 商業後台前端：銷售數據、商品管理、訂單管理、行銷工具
- 後端API：RESTful API服務，提供全方位電商功能支援

## 聯繫方式

如有任何問題或建議，請隨時聯繫：
- 電子郵件: emy0526@gmail.com

---

感謝您審閱此專案！
