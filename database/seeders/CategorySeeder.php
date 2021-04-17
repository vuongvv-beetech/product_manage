<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('productcategorys')->insert([
            [
                'name' => 'sức khỏe',
                'parent_id' => '1',
                'expired_at' => '2020-12-12',
            ],
            [
                'name' => 'điện tử',
                'parent_id' => '1',
                'expired_at' => '2020-12-12',
            ],
            [
                'name' => 'điện thoại',
                'parent_id' => '1',
                'expired_at' => '2020-12-12',
            ],
            [
                'name' => 'điện máy',
                'parent_id' => '1',
                'expired_at' => '2020-12-12',
            ],
            [
                'name' => 'máy ảnh',
                'parent_id' => '1',
                'expired_at' => '2020-12-12',
            ],
            [
                'name' => 'gia dụng',
                'parent_id' => '1',
                'expired_at' => '2020-12-12',
            ],
            [
                'name' => 'thể thao',
                'parent_id' => '1',
                'expired_at' => '2020-12-12',
            ],
            [
                'name' => 'giải trí',
                'parent_id' => '1',
                'expired_at' => '2020-12-12',
            ],
            [
                'name' => 'ô tô',
                'parent_id' => '1',
                'expired_at' => '2020-12-12',
            ],
            [
                'name' => 'trẻ em',
                'parent_id' => '1',
                'expired_at' => '2020-12-12',
            ],
            [
                'name' => 'dịch vụ',
                'parent_id' => '1',
                'expired_at' => '2020-12-12',
            ],

            [
                'name' => 'làm đẹp',
                'parent_id' => '1',
                'expired_at' => '2020-12-12',
            ],
            [
                'name' => 'spa',
                'parent_id' => '1',
                'expired_at' => '2020-12-12',
            ],
            [
                'name' => 'thời trang',
                'parent_id' => '1',
                'expired_at' => '2020-12-12',
            ],
            [
                'name' => 'ăn uống',
                'parent_id' => '1',
                'expired_at' => '2020-12-12',
            ],
            [
                'name' => 'thương hiệu',
                'parent_id' => '1',
                'expired_at' => '2020-12-12',
            ],
            [
                'name' => 'đồng hồ',
                'parent_id' => '1',
                'expired_at' => '2020-12-12',
            ]
        ]);
    }
}
