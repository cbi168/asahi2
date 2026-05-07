<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\ArticleCategoryController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController as FrontProductController;
use Illuminate\Support\Facades\Route;

// ==================== 前台路由（不需要認證） ====================

// 首頁
Route::get('/', [HomeController::class, 'index'])->name('home');

// 前台測試頁面（用於驗收階段 8）
Route::get('/frontend-test', function () {
    return view('frontend-test');
})->name('frontend-test');

// 關於我們頁面
Route::get('/about', function () {
    return view('about');
})->name('about');

// 文章列表和詳情頁
Route::prefix('articles')->name('articles.')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('index');
    Route::get('/{id}', [ArticleController::class, 'show'])->name('show');
});

// 商品列表和詳情頁
Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [FrontProductController::class, 'index'])->name('index');
    Route::get('/{id}', [FrontProductController::class, 'show'])->name('show');
});

// 聯絡我們頁面
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// ==================== 後台認證路由（不需要中介層） ====================
Route::prefix('admin')->name('admin.')->group(function () {
    // 登入相關路由
    Route::get('/login', [AdminAuthController::class, 'login'])->name('login');
    Route::post('/authenticate', [AdminAuthController::class, 'authenticate'])->name('authenticate');

    // 登出路由（支援 GET 和 POST 方法，方便測試）
    Route::match(['get', 'post'], '/logout', [AdminAuthController::class, 'logout'])
        ->name('logout')
        ->middleware('auth');

    // 需要認證的路由
    Route::middleware(['admin.auth'])->group(function () {
        // 儀表板（將 /admin 設為首頁）
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // 舊的 dashboard 路由重導向到新首頁（保持相容性）
        Route::redirect('/dashboard', '/admin', 301);

        // 幻燈片管理
        Route::prefix('sliders')->name('sliders.')->group(function () {
            Route::get('/', [SliderController::class, 'index'])->name('index');
            Route::get('/create', [SliderController::class, 'create'])->name('create');
            Route::post('/', [SliderController::class, 'store'])->name('store');
            Route::get('/{slider}/edit', [SliderController::class, 'edit'])->name('edit');
            Route::put('/{slider}', [SliderController::class, 'update'])->name('update');
            Route::delete('/{slider}', [SliderController::class, 'destroy'])->name('destroy');
            Route::post('/{slider}/toggle', [SliderController::class, 'toggleStatus'])->name('toggle');
        });

        // 影片管理
        Route::prefix('videos')->name('videos.')->group(function () {
            Route::get('/', [VideoController::class, 'index'])->name('index');
            Route::get('/create', [VideoController::class, 'create'])->name('create');
            Route::post('/', [VideoController::class, 'store'])->name('store');
            Route::get('/{video}/edit', [VideoController::class, 'edit'])->name('edit');
            Route::put('/{video}', [VideoController::class, 'update'])->name('update');
            Route::delete('/{video}', [VideoController::class, 'destroy'])->name('destroy');
            Route::post('/{video}/toggle', [VideoController::class, 'toggleStatus'])->name('toggle');
        });

        // 文章分類管理
        Route::prefix('article-categories')->name('article-categories.')->group(function () {
            Route::get('/', [ArticleCategoryController::class, 'index'])->name('index');
            Route::get('/create', [ArticleCategoryController::class, 'create'])->name('create');
            Route::post('/', [ArticleCategoryController::class, 'store'])->name('store');
            Route::get('/{articleCategory}/edit', [ArticleCategoryController::class, 'edit'])->name('edit');
            Route::put('/{articleCategory}', [ArticleCategoryController::class, 'update'])->name('update');
            Route::delete('/{articleCategory}', [ArticleCategoryController::class, 'destroy'])->name('destroy');
        });

        // 文章管理
        Route::prefix('articles')->name('articles.')->group(function () {
            Route::get('/', [AdminArticleController::class, 'index'])->name('index');
            Route::get('/create', [AdminArticleController::class, 'create'])->name('create');
            Route::post('/', [AdminArticleController::class, 'store'])->name('store');
            Route::get('/{article}/edit', [AdminArticleController::class, 'edit'])->name('edit');
            Route::put('/{article}', [AdminArticleController::class, 'update'])->name('update');
            Route::delete('/{article}', [AdminArticleController::class, 'destroy'])->name('destroy');
            Route::post('/{article}/toggle', [AdminArticleController::class, 'toggleStatus'])->name('toggle');
        });

        // 商品管理
        Route::prefix('products')->name('products.')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('/create', [ProductController::class, 'create'])->name('create');
            Route::post('/', [ProductController::class, 'store'])->name('store');
            Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
            Route::put('/{product}', [ProductController::class, 'update'])->name('update');
            Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
            Route::post('/{product}/toggle', [ProductController::class, 'toggleStatus'])->name('toggle');
        });

        // 聯絡訊息管理
        Route::prefix('contacts')->name('contacts.')->group(function () {
            Route::get('/', [AdminContactController::class, 'index'])->name('index');
            Route::get('/{contact}', [AdminContactController::class, 'show'])->name('show');
            Route::post('/{contact}/toggle-read', [AdminContactController::class, 'toggleRead'])->name('toggle-read');
            Route::delete('/{contact}', [AdminContactController::class, 'destroy'])->name('destroy');
        });

        // 後台用戶管理
        Route::prefix('admin-users')->name('admin-users.')->group(function () {
            Route::get('/', [AdminUserController::class, 'index'])->name('index');
            Route::get('/create', [AdminUserController::class, 'create'])->name('create');
            Route::post('/', [AdminUserController::class, 'store'])->name('store');
            Route::get('/{adminUser}/edit', [AdminUserController::class, 'edit'])->name('edit');
            Route::put('/{adminUser}', [AdminUserController::class, 'update'])->name('update');
            Route::delete('/{adminUser}', [AdminUserController::class, 'destroy'])->name('destroy');
            Route::post('/{adminUser}/toggle-status', [AdminUserController::class, 'toggleStatus'])->name('toggle-status');
        });

        // 其他路由將在後續階段添加
        // Route::resource('videos', VideoController::class);
        // Route::resource('articles', ArticleController::class);
        // Route::resource('products', ProductController::class);
        // Route::resource('contacts', ContactController::class);
    });
});
