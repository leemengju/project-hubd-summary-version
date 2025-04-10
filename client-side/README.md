# HUBD 快時尚購物平台 — 前台客戶端（Laravel MVC）

---
### 專案簡介
HUBD 快時尚購物平台 — 客戶端前台
使用 Laravel MVC 架構開發，支援身分驗證、商品瀏覽、收藏功能與購物流程。

### 技術架構
- PHP 8+ / Laravel 11
- Laravel Breeze（身分驗證）
- Eloquent ORM
- jQuery
- Tailwind CSS（搭配 Vite）
- MariaDB 資料庫
- RESTful API 設計

### 專案架構說明
#### 路由設定
- 所有前台路由定義於 `routes/web.php`

#### Views
- 使用 `app.blade.php` 作為基底模板
- 共用元件（如 navbar、footer）使用 `@include` 引入
- 各頁面（如 home.blade.php、about_us.blade.php、cart.blade.php）透過 `@yield('content')` 插入內容

#### Model / Controller
- 每張資料表對應一個 Eloquent Model
- 每個頁面有對應的 Controller，如 `HomeController`、`CartController`

### 專案初始化指令
```bash
composer install
cp .env.example .env
php artisan key:generate
npm install
npm run dev
```
