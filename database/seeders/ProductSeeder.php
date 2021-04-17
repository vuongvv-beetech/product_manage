<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'sku' => 'slk',
                'name' => 'sách',
                'stock' => '1',
                'avatar' => '12',
                'expired_at' => '2020-12-12',
                'catrgory_id' => '1',
            ],
            [
                'sku' => '231kj',
                'name' => 'balo',
                'stock' => '1',
                'avatar' => '13',
                'expired_at' => '2020-12-12',
                'catrgory_id' => '1',
            ],
            [
                'sku' => 'klxc',
                'name' => 'sao',
                'stock' => '1',
                'avatar' => '14',
                'expired_at' => '2020-12-12',
                'catrgory_id' => '1',
            ],
            [
                'sku' => 'mkd',
                'name' => 'dao',
                'stock' => '1',
                'avatar' => '15',
                'expired_at' => '2020-12-12',
                'catrgory_id' => '1',
            ],
            [
                'sku' => 'via',
                'name' => 'kéo',
                'stock' => '1',
                'avatar' => '16',
                'expired_at' => '2020-12-12',
                'catrgory_id' => '1',
            ],
            [
                'sku' => 'kaw',
                'name' => 'bàn',
                'stock' => '1',
                'avatar' => '17',
                'expired_at' => '2020-12-12',
                'catrgory_id' => '1',
            ],

            [
                'sku' => 'lpo',
                'name' => 'bàn phím',
                'stock' => '1',
                'avatar' => '18',
                'expired_at' => '2020-12-12',
                'catrgory_id' => '1',
            ],
            [
                'sku' => 'vdl',
                'name' => 'tủ',
                'stock' => '1',
                'avatar' => '19',
                'expired_at' => '2020-12-12',
                'catrgory_id' => '1',
            ],
            [
                'sku' => 'mla',
                'name' => 'ghế',
                'stock' => '1',
                'avatar' => '10',
                'expired_at' => '2020-12-12',
                'catrgory_id' => '1',
            ],
            [
                'sku' => 'jwk',
                'name' => 'cháo',
                'stock' => '1',
                'avatar' => '21',
                'expired_at' => '2020-12-12',
                'catrgory_id' => '1',
            ],
            [
                'sku' => 'vdq',
                'name' => 'bóng đèn',
                'stock' => '1',
                'avatar' => '31',
                'expired_at' => '2020-12-12',
                'catrgory_id' => '1',
            ],
            [
                'sku' => 'mlv',
                'name' => 'notebook',
                'stock' => '1',
                'avatar' => '41',
                'expired_at' => '2020-12-12',
                'catrgory_id' => '1',
            ],
            [
                'sku' => 'lls',
                'name' => 'son',
                'stock' => '1',
                'avatar' => '51',
                'expired_at' => '2020-12-12',
                'catrgory_id' => '1',
            ],
            [
                'sku' => '33n',
                'name' => 'găng tay',
                'stock' => '1',
                'avatar' => '61',
                'expired_at' => '2020-12-12',
                'catrgory_id' => '1',
            ],
            [
                'sku' => 'clj',
                'name' => 'quần',
                'stock' => '1',
                'avatar' => '71',
                'expired_at' => '2020-12-12',
                'catrgory_id' => '1',
            ],
            [
                'sku' => 'ja9',
                'name' => 'áo',
                'stock' => '1',
                'avatar' => '81',
                'expired_at' => '2020-12-12',
                'catrgory_id' => '1',
            ],
        ]);
    }
}
