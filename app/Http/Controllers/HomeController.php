<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * 顯示首頁
     *
     * @return View
     */
    public function index()
    {
        // 取得啟用的幻燈片（倒序排列）
        $sliders = Slider::where('is_active', 1)
            ->orderBy('sort_order', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        // 取得最新的 6 篇文章（已啟用且發布日期已到）
        $articles = Article::where('is_active', 1)
            ->where('publish_date', '<=', now())
            ->orderBy('publish_date', 'desc')
            ->orderBy('id', 'desc')
            ->limit(6)
            ->get();

        // 取得最多 6 個精選商品（已啟用，倒序排列）
        $products = Product::where('is_active', 1)
            ->orderBy('sort_order', 'desc')
            ->orderBy('id', 'desc')
            ->limit(6)
            ->get();

        return view('home', compact('sliders', 'articles', 'products'));
    }
}
