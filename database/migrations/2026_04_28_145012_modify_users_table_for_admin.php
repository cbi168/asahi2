<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * 執行資料庫遷移。
     * 新增 role 和 is_active 欄位到 users 表。
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 新增角色欄位（預設為 'user'）
            $table->enum('role', ['admin', 'user'])->default('user')->after('email');

            // 新增啟用狀態欄位（預設為 1，表示啟用）
            $table->tinyInteger('is_active')->default(1)->after('role');
        });
    }

    /**
     * 回滾資料庫遷移。
     * 移除 role 和 is_active 欄位。
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'is_active']);
        });
    }
};
