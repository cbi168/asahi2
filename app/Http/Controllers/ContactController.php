<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * 顯示聯絡我們頁面
     *
     * @return View
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * 處理聯絡表單提交
     *
     * @return RedirectResponse
     */
    public function submit(Request $request)
    {
        // 表單驗證
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ], [
            'name.required' => '請填寫您的姓名',
            'email.required' => '請填寫您的 Email',
            'email.email' => '請填寫有效的 Email 位址',
            'message.required' => '請填寫訊息內容',
        ]);

        // 建立聯絡訊息
        Contact::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'subject' => $validated['subject'] ?? null,
            'message' => $validated['message'],
            'is_read' => false,
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('contact')->with('success', '訊息已送出，我們會盡快回覆您');
    }
}
