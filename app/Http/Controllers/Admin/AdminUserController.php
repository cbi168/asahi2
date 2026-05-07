<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    /**
     * 顯示管理員列表
     */
    public function index(): View
    {
        $adminUsers = User::where('role', 'admin')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.admin-users.index', compact('adminUsers'));
    }

    /**
     * 顯示新增管理員表單
     */
    public function create(): View
    {
        return view('admin.admin-users.create');
    }

    /**
     * 處理新增管理員邏輯
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => '請輸入姓名',
            'email.required' => '請輸入 Email',
            'email.email' => 'Email 格式不正確',
            'email.unique' => '該 Email 已被使用',
            'password.required' => '請輸入密碼',
            'password.min' => '密碼至少需要 6 個字元',
            'password.confirmed' => '密碼確認不一致',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'admin',
            'is_active' => true,
        ]);

        return redirect()
            ->route('admin.admin-users.index')
            ->with('success', '管理員已成功新增');
    }

    /**
     * 顯示編輯管理員表單
     */
    public function edit(User $adminUser): View
    {
        return view('admin.admin-users.edit', compact('adminUser'));
    }

    /**
     * 處理更新管理員邏輯
     */
    public function update(Request $request, User $adminUser): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$adminUser->id,
            'password' => 'nullable|string|min:6|confirmed',
        ], [
            'name.required' => '請輸入姓名',
            'email.required' => '請輸入 Email',
            'email.email' => 'Email 格式不正確',
            'email.unique' => '該 Email 已被使用',
            'password.min' => '密碼至少需要 6 個字元',
            'password.confirmed' => '密碼確認不一致',
        ]);

        $adminUser->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        // 如果有輸入新密碼，則更新密碼
        if (! empty($validated['password'])) {
            $adminUser->update([
                'password' => Hash::make($validated['password']),
            ]);
        }

        return redirect()
            ->route('admin.admin-users.index')
            ->with('success', '管理員資料已成功更新');
    }

    /**
     * 刪除管理員
     */
    public function destroy(User $adminUser): RedirectResponse
    {
        // 檢查是否嘗試刪除自己
        if ($adminUser->id === auth()->id()) {
            return redirect()
                ->route('admin.admin-users.index')
                ->with('error', '無法刪除自己的帳號');
        }

        $adminUser->delete();

        return redirect()
            ->route('admin.admin-users.index')
            ->with('success', '管理員已成功刪除');
    }

    /**
     * 切換管理員啟用/停用狀態
     */
    public function toggleStatus(User $adminUser): RedirectResponse
    {
        // 檢查是否嘗試停用自己
        if ($adminUser->id === auth()->id()) {
            return redirect()
                ->route('admin.admin-users.index')
                ->with('error', '無法停用自己的帳號');
        }

        $adminUser->update([
            'is_active' => ! $adminUser->is_active,
        ]);

        $status = $adminUser->is_active ? '啟用' : '停用';

        return redirect()
            ->route('admin.admin-users.index')
            ->with('success', "管理員已成功{$status}");
    }
}
