<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * 可大量賦值的欄位
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'content',
        'price',
        'image',
        'sort_order',
        'is_active',
    ];

    /**
     * 欄位類型轉換
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * 格式化價格顯示
     */
    public function getFormattedPriceAttribute(): string
    {
        return 'NT$ '.number_format($this->price, 0);
    }

    /**
     * 查詢啟用的商品
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
