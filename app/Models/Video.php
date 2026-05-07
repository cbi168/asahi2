<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * 影片 Model
 *
 * 處理 YouTube 影片資料的儲存和管理
 */
class Video extends Model
{
    /**
     * 可批量賦值的欄位
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'youtube_url',
        'video_id',
        'thumbnail',
        'sort_order',
        'is_active',
    ];

    /**
     * 欄位型別轉換
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * 解析 YouTube URL 並提取影片 ID
     *
     * 支援多種 YouTube 網址格式：
     * - 標準網址：https://www.youtube.com/watch?v=VIDEO_ID
     * - 短網址：https://youtu.be/VIDEO_ID
     * - 嵌入網址：https://www.youtube.com/embed/VIDEO_ID
     *
     * @param  string  $url  YouTube 網址
     * @return string|null 影片 ID，若解析失敗回傳 null
     */
    public static function parseYoutubeId(string $url): ?string
    {
        // 標準網址格式：https://www.youtube.com/watch?v=VIDEO_ID
        if (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return $matches[1];
        }

        // 短網址格式：https://youtu.be/VIDEO_ID
        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return $matches[1];
        }

        // 嵌入網址格式：https://www.youtube.com/embed/VIDEO_ID
        if (preg_match('/youtube\.com\/embed\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return $matches[1];
        }

        // 短嵌入網址格式：https://www.youtube.com/v/VIDEO_ID
        if (preg_match('/youtube\.com\/v\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return $matches[1];
        }

        return null;
    }

    /**
     * 根據影片 ID 生成 YouTube 縮圖網址
     *
     * @param  string  $videoId  YouTube 影片 ID
     * @return string 縮圖網址
     */
    public static function getThumbnailUrl(string $videoId): string
    {
        return "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg";
    }

    /**
     * 自動設定影片 ID 和縮圖網址
     *
     * 當 youtube_url 變更時，自動解析並設定 video_id 和 thumbnail
     *
     * @param  string  $url  YouTube 網址
     */
    public function setYoutubeUrlAttribute(string $url): void
    {
        $this->attributes['youtube_url'] = $url;

        $videoId = self::parseYoutubeId($url);
        if ($videoId) {
            $this->attributes['video_id'] = $videoId;
            $this->attributes['thumbnail'] = self::getThumbnailUrl($videoId);
        }
    }

    /**
     * 查詢啟用的影片
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * 依照排序倒序排列
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeOrderBySortOrder($query)
    {
        return $query->orderBy('sort_order', 'desc');
    }
}
