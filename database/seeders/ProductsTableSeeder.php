<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productNames = [
            ['product_name' => 'スパークリングベリーフュージョン'],
            ['product_name' => 'クランチーアップルリフレッシュ'],
            ['product_name' => 'フローズンキャラメルブレイズ'],
            ['product_name' => 'エナジーフューエルブースト'],
            ['product_name' => 'ピーチティーインフュージョン'],
            ['product_name' => 'ラズベリーレモネードバースト'],
            ['product_name' => 'アイスドミントチョコフリーズ'],
            ['product_name' => 'シトラスブリーズブラスト'],
            ['product_name' => 'ビタミンキックスムージー'],
            ['product_name' => 'キャラメルマキアートデライト'],
            ['product_name' => 'オーガニックマンゴーパンチ'],
            ['product_name' => 'ブルーラグーンエナジャイザー'],
            ['product_name' => 'ピナコラーダサマーウェーブ'],
            ['product_name' => 'バニラシナモンドリーム'],
            ['product_name' => 'レモングリーンティーフロスト'],
            ['product_name' => 'モヒートミストリフレッシャー'],
            ['product_name' => 'グレープフルーツスプラッシュ'],
            ['product_name' => 'マンゴーライムブリーズ'],
            ['product_name' => 'チョコミントモカジャンブル'],
            ['product_name' => 'スイカストロベリーエクスプロージョン'],
        ];

        Product::factory(count($productNames))
            ->state(new Sequence(...$productNames))
            ->create();
    }
}
