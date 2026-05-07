<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * 顯示商品列表
     *
     * @return View
     */
    public function index(Request $request)
    {
        // 查詢啟用的商品，按照排序倒序排列，每頁 12 個
        $products = Product::where('is_active', true)
            ->orderBy('sort_order', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(12);

        return view('products.index', compact('products'));
    }

    /**
     * 顯示商品詳情
     *
     * @param  int  $id
     * @return View
     */
    public function show($id)
    {
        // 查詢啟用的商品，如果不存在或已停用則返回 404
        $product = Product::where('is_active', true)
            ->findOrFail($id);

        return view('products.show', compact('product'));
    }
}
