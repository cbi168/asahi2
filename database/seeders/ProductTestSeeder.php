<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => '高級辦公椅',
                'description' => '<p>人體工學設計，提供最佳支撐舒適度。</p><ul><li>可調節高度</li><li>透氣網布</li><li>360度旋轉</li></ul>',
                'price' => 5800,
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'LED 桌燈',
                'description' => '<p>護眼 LED 燈，多段亮度調節。</p><ul><li>三段色溫調節</li><li>USB 供電</li><li>觸控開關</li></ul>',
                'price' => 1200,
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => '筆記型電腦支架',
                'description' => '<p>鋁合金材質，可調節角度和高度。</p><ul><li>散熱設計</li><li>穩固耐用</li><li>摺疊便利</li></ul>',
                'price' => 850,
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => '無線滑鼠',
                'description' => '<p>人體工學設計，靜音按鍵。</p><ul><li>2.4G 無線連接</li><li>長續航力</li><li>DPI 調節</li></ul>',
                'price' => 450,
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => '機械式鍵盤',
                'description' => '<p>青軸開關，給您最佳的打字體驗。</p><ul><li>RGB 背光</li><li>多媒體按鍵</li><li>鋁合金底板</li></ul>',
                'price' => 2500,
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'USB-C 擴充座',
                'description' => '<p>多功能擴充座，滿足各種連接需求。</p><ul><li>HDMI 輸出</li><li>USB 3.0 埠</li><li>快充功能</li></ul>',
                'price' => 1680,
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'name' => '降噪耳機',
                'description' => '<p>主動降噪技術，享受靜謐音樂。</p><ul><li>30 小時續航</li><li>藍牙 5.0</li><li>快充支援</li></ul>',
                'price' => 3200,
                'sort_order' => 7,
                'is_active' => true,
            ],
            [
                'name' => '智慧音箱',
                'description' => '<p>AI 語音助手，智慧生活好幫手。</p><ul><li>360度音效</li><li>語音控制</li><li>Wi-Fi 連接</li></ul>',
                'price' => 2900,
                'sort_order' => 8,
                'is_active' => true,
            ],
            [
                'name' => '行動電源',
                'description' => '<p>大容量電池，隨時補充裝置電力。</p><ul><li>20000mAh</li><li>雙 USB 輸出</li><li>快充技術</li></ul>',
                'price' => 790,
                'sort_order' => 9,
                'is_active' => true,
            ],
            [
                'name' => '平板電腦支架',
                'description' => '<p>多角度調節，適用各種尺寸平板。</p><ul><li>防滑設計</li><li>輕便攜帶</li><li>鋁合金材質</li></ul>',
                'price' => 680,
                'sort_order' => 10,
                'is_active' => true,
            ],
            [
                'name' => '網路攝像機',
                'description' => '<p>1080P HD 畫質，支援夜視功能。</p><ul><li>遠端監控</li><li>移動偵測</li><li>雙向語音</li></ul>',
                'price' => 1890,
                'sort_order' => 11,
                'is_active' => true,
            ],
            [
                'name' => '智慧手錶',
                'description' => '<p>健康監測，運動追蹤，您的貼身助理。</p><ul><li>心率監測</li><li>GPS 定位</li><li>防水設計</li></ul>',
                'price' => 4500,
                'sort_order' => 12,
                'is_active' => true,
            ],
            [
                'name' => '藍牙喇叭',
                'description' => '<p>360度環繞音效，防水設計。</p><ul><li>12小時續航</li><li>藍牙5.0</li><li>防水等級IPX7</li></ul>',
                'price' => 1500,
                'sort_order' => 13,
                'is_active' => false,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        $this->command->info('測試商品資料建立完成！');
    }
}
