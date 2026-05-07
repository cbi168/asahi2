<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * 執行資料庫填充。
     * 建立預設管理員帳號。
     */
    public function run(): void
    {
        // 建立預設管理員
        User::updateOrCreate(
            ['email' => 'admin@example.com'], // 使用 email 作為查找條件
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'), // 密碼: password
                'role' => 'admin', // 設定為管理員角色
                'is_active' => 1, // 啟用狀態
            ]
        );

        $this->command->info('預設管理員已建立成功！');
        $this->command->info('Email: admin@example.com');
        $this->command->info('Password: password');
    }
}
