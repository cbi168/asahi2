<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * 處理傳入的請求。
     * 驗證用戶是否為管理員且已登入。
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 檢查用戶是否已登入
        if (! Auth::check()) {
            return redirect()->route('admin.login')->with('error', '請先登入！');
        }

        // 檢查用戶是否為管理員
        if (Auth::user()->role !== 'admin') {
            Auth::logout();

            return redirect()->route('admin.login')->with('error', '您沒有權限訪問後台！');
        }

        // 檢查用戶是否已啟用
        if (! Auth::user()->is_active) {
            Auth::logout();

            return redirect()->route('admin.login')->with('error', '您的帳號已被停用！');
        }

        return $next($request);
    }
}
