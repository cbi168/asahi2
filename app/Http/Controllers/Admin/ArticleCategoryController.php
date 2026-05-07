<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleCategoryController extends Controller
{
    /**
     * 顯示分類列表（倒序排列）
     */
    public function index()
    {
        $categories = ArticleCategory::orderBy('sort_order', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.article-categories.index', compact('categories'));
    }

    /**
     * 顯示新增分類表單
     */
    public function create()
    {
        return view('admin.article-categories.form');
    }

    /**
     * 處理新增分類邏輯（驗證名稱唯一性）
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:article_categories,name',
            'sort_order' => 'required|integer|min:0',
        ], [
            'name.required' => '分類名稱為必填',
            'name.unique' => '分類名稱已存在',
            'sort_order.required' => '排序為必填',
            'sort_order.integer' => '排序必須為整數',
            'sort_order.min' => '排序不能為負數',
        ]);

        ArticleCategory::create($validated);

        return redirect()->route('admin.article-categories.index')
            ->with('success', '分類新增成功');
    }

    /**
     * 顯示編輯分類表單
     */
    public function edit(ArticleCategory $articleCategory)
    {
        return view('admin.article-categories.form', compact('articleCategory'));
    }

    /**
     * 處理更新分類邏輯
     */
    public function update(Request $request, ArticleCategory $articleCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:article_categories,name,'.$articleCategory->id,
            'sort_order' => 'required|integer|min:0',
        ], [
            'name.required' => '分類名稱為必填',
            'name.unique' => '分類名稱已存在',
            'sort_order.required' => '排序為必填',
            'sort_order.integer' => '排序必須為整數',
            'sort_order.min' => '排序不能為負數',
        ]);

        $articleCategory->update($validated);

        return redirect()->route('admin.article-categories.index')
            ->with('success', '分類更新成功');
    }

    /**
     * 處理刪除分類邏輯（檢查是否有關聯文章）
     */
    public function destroy(ArticleCategory $articleCategory)
    {
        // 檢查是否有關聯文章
        // 注意：由於 Article 表尚未建立，這裡先簡化處理
        // 當階段 5 文章管理完成後，需要加入關聯檢查
        $articleCategory->delete();

        return redirect()->route('admin.article-categories.index')
            ->with('success', '分類刪除成功');
    }
}
