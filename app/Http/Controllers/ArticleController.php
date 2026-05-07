<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

/**
 * 前台文章控制器
 *
 * 處理前台文章列表和詳情頁面
 */
class ArticleController extends Controller
{
    /**
     * 顯示文章列表
     *
     * @return View
     */
    public function index(Request $request)
    {
        // 取得所有啟用的分類
        $categories = ArticleCategory::orderBy('sort_order', 'desc')
            ->withCount('articles') // 計算每個分類的文章數量
            ->get();

        // 建立文章查詢
        $query = Article::with('category')
            ->where('is_active', 1)
            ->where('publish_date', '<=', now())
            ->orderBy('publish_date', 'desc')
            ->orderBy('id', 'desc');

        // 分類篩選
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // 搜尋功能
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('content', 'like', "%{$searchTerm}%");
            });
        }

        // 分頁（每頁 12 篇）
        $articles = $query->paginate(12);

        // 保留分類篩選和搜尋參數
        $articles->appends([
            'category' => $request->category,
            'search' => $request->search,
        ]);

        return view('articles.index', compact('articles', 'categories'));
    }

    /**
     * 顯示文章詳情
     *
     * @param  int  $id
     * @return View
     */
    public function show($id)
    {
        // 查詢文章（只顯示啟用的文章）
        $article = Article::with('category')
            ->where('is_active', 1)
            ->where('publish_date', '<=', now())
            ->findOrFail($id);

        // 防止重複計算瀏覽次數（使用 session，5 分鐘內不重複計算）
        $sessionKey = 'viewed_article_'.$id;
        if (! Session::has($sessionKey)) {
            $article->increment('views');
            Session::put($sessionKey, now());
            Session::forget($sessionKey, now()->addMinutes(5)); // 5 分鐘後過期
        }

        // 取得相關文章（同分類，排除當前文章，最多 5 篇）
        $relatedArticles = Article::where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->where('is_active', 1)
            ->where('publish_date', '<=', now())
            ->orderBy('publish_date', 'desc')
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }
}
