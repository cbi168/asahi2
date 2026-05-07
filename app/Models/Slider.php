<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    /**
     * 可大量賦值的欄位
     */
    protected $fillable = [
        'title',
        'image',
        'sort_order',
        'is_active',
    ];

    /**
     * 欄位型別轉換
     */
    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * 查詢啟用的幻燈片
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * 依排序倒序排列
     */
    public function scopeOrderBySort($query)
    {
        return $query->orderBy('sort_order', 'desc')->orderBy('id', 'desc');
    }
}
