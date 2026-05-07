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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // 影片標題
            $table->string('youtube_url'); // YouTube 網址
            $table->string('video_id'); // YouTube 影片 ID
            $table->string('thumbnail')->nullable(); // 縮圖網址
            $table->integer('sort_order')->default(0); // 排序
            $table->boolean('is_active')->default(true); // 狀態
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
