<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    /**
     * 可批量賦值的欄位
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'sort_order',
    ];

    /**
     * 取得該分類下的所有文章
     */
    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id');
    }
}
