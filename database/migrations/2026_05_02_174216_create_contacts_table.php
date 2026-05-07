<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // 姓名
            $table->string('email'); // Email
            $table->string('phone')->nullable(); // 電話（選填）
            $table->string('subject')->nullable(); // 主旨（選填）
            $table->text('message'); // 訊息內容
            $table->boolean('is_read')->default(false); // 是否已讀，預設 false
            $table->string('ip_address', 45)->nullable(); // IP 位址（支援 IPv6）
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
