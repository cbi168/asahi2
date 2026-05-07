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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // 商品名稱
            $table->text('description')->nullable(); // 商品描述
            $table->decimal('price', 10, 2)->default(0); // 價格
            $table->string('image')->nullable(); // 商品圖片
            $table->integer('sort_order')->default(0); // 排序
            $table->boolean('is_active')->default(true); // 啟用狀態
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
