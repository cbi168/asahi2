<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    /**
     * 顯示後台登入頁面。
     */
    public function login()
    {
        // 如果已經登入，重導向到後台首頁
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    /**
     * 處理登入請求。
     */
    public function authenticate(Request $request)
    {
        // 驗證表單資料
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 嘗試登入
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            // 檢查用戶是否為管理員且已啟用
            if (Auth::user()->role === 'admin' && Auth::user()->is_active) {
                return redirect()->intended(route('admin.dashboard'));
            }

            // 如果不是管理員或未啟用，登出並顯示錯誤
            Auth::logout();

            return back()->withErrors([
                'email' => '您沒有權限訪問後台或帳號已被停用。',
            ])->onlyInput('email');
        }

        // 登入失敗
        return back()->withErrors([
            'email' => '登入失敗，請檢查您的帳號密碼。',
        ])->onlyInput('email');
    }

    /**
     * 處理登出請求。
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // 清除 Session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', '您已成功登出！');
    }
}
