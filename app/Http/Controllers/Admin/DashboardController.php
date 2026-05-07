<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * 顯示後台儀表板。
     */
    public function index()
    {
        return view('admin.dashboard');
    }
}
