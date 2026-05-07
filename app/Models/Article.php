<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * 可批量賦值的屬性
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'title',
        'content',
        'image',
        'publish_date',
        'views',
        'is_active',
    ];

    /**
     * 屬性轉換
     *
     * @var array<string, string>
     */
    protected $casts = [
        'publish_date' => 'date',
        'views' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * 取得文章所屬的分類
     */
    public function category()
    {
        return $this->belongsTo(ArticleCategory::class, 'category_id');
    }
}
