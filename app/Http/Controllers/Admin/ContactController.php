<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * 顯示聯絡訊息列表
     */
    public function index(): View
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(20);

        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * 顯示聯絡訊息詳情（自動標記已讀）
     */
    public function show(Contact $contact): View
    {
        // 自動標記為已讀
        if (! $contact->is_read) {
            $contact->update(['is_read' => true]);
        }

        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * 切換訊息已讀/未讀狀態
     */
    public function toggleRead(Contact $contact): RedirectResponse
    {
        $contact->update([
            'is_read' => ! $contact->is_read,
        ]);

        return redirect()
            ->route('admin.contacts.index')
            ->with('success', $contact->is_read ? '訊息已標記為已讀' : '訊息已標記為未讀');
    }

    /**
     * 刪除聯絡訊息
     */
    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();

        return redirect()
            ->route('admin.contacts.index')
            ->with('success', '訊息已刪除');
    }
}
