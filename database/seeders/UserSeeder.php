<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'User3',
                'email' => 'user3@gmail.com',
                'password' => bcrypt('admin123'),
                'birthday' => '1999-1-1',
                'first_name'=> 'vua',
                'last_name' => 'huyenaz',
                'reset_password' => bcrypt('admin123'),
                'status' => '1',
                'flag_delete'=> '1',
                'province_id'=>'1',
                'district_id'=>'1',
                'commune_id'=>'1'
            ],
            [
                'name' => 'User4',
                'email' => 'user4@gmail.com',
                'password' => bcrypt('admin123'),
                'birthday' => '1999-1-1',
                'first_name'=> 'vus',
                'last_name' => 'huyenas',
                'reset_password' => bcrypt('admin123'),
                'status' => '1',
                'flag_delete'=> '1',
                'province_id'=>'1',
                'district_id'=>'1',
                'commune_id'=>'1'
            ],
            [
                'name' => 'User5',
                'email' => 'user5@gmail.com',
                'password' => bcrypt('admin123'),
                'birthday' => '1999-1-1',
                'first_name'=> 'vuf',
                'last_name' => 'huyend',
                'reset_password' => bcrypt('admin123'),
                'status' => '1',
                'flag_delete'=> '1',
                'province_id'=>'1',
                'district_id'=>'1',
                'commune_id'=>'1'
            ],
            [
                'name' => 'User6',
                'email' => 'user6@gmail.com',
                'password' => bcrypt('admin123'),
                'birthday' => '1999-1-1',
                'first_name'=> 'vug',
                'last_name' => 'huyenre',
                'reset_password' => bcrypt('admin123'),
                'status' => '1',
                'flag_delete'=> '1',
                'province_id'=>'1',
                'district_id'=>'1',
                'commune_id'=>'1'
            ],
            [
                'name' => 'User7',
                'email' => 'user7@gmail.com',
                'password' => bcrypt('admin123'),
                'birthday' => '1999-1-1',
                'first_name'=> 'vuh',
                'last_name' => 'huyengre',
                'reset_password' => bcrypt('admin123'),
                'status' => '1',
                'flag_delete'=> '1',
                'province_id'=>'1',
                'district_id'=>'1',
                'commune_id'=>'1'
            ],
            [
                'name' => 'User8',
                'email' => 'user8@gmail.com',
                'password' => bcrypt('admin123'),
                'birthday' => '1999-1-1',
                'first_name'=> 'vuj',
                'last_name' => 'huyenaf',
                'reset_password' => bcrypt('admin123'),
                'status' => '1',
                'flag_delete'=> '1',
                'province_id'=>'1',
                'district_id'=>'1',
                'commune_id'=>'1'
            ],
            [
                'name' => 'User9',
                'email' => 'user9@gmail.com',
                'password' => bcrypt('admin123'),
                'birthday' => '1999-1-1',
                'first_name'=> 'vuk',
                'last_name' => 'huyengf',
                'reset_password' => bcrypt('admin123'),
                'status' => '1',
                'flag_delete'=> '1',
                'province_id'=>'1',
                'district_id'=>'1',
                'commune_id'=>'1'
            ],
            [
                'name' => 'User10',
                'email' => 'user10@gmail.com',
                'password' => bcrypt('admin123'),
                'birthday' => '1999-1-1',
                'first_name'=> 'vul',
                'last_name' => 'huyenhg',
                'reset_password' => bcrypt('admin123'),
                'status' => '1',
                'flag_delete'=> '1',
                'province_id'=>'1',
                'district_id'=>'1',
                'commune_id'=>'1'
            ],
            [
                'name' => 'User11',
                'email' => 'user11@gmail.com',
                'password' => bcrypt('admin123'),
                'birthday' => '1999-1-1',
                'first_name'=> 'vur',
                'last_name' => 'huyenrt',
                'reset_password' => bcrypt('admin123'),
                'status' => '1',
                'flag_delete'=> '1',
                'province_id'=>'1',
                'district_id'=>'1',
                'commune_id'=>'1'
            ],
            [
                'name' => 'User12',
                'email' => 'user12@gmail.com',
                'password' => bcrypt('admin123'),
                'birthday' => '1999-1-1',
                'first_name'=> 'vuq',
                'last_name' => 'huyenhf',
                'reset_password' => bcrypt('admin123'),
                'status' => '1',
                'flag_delete'=> '1',
                'province_id'=>'1',
                'district_id'=>'1',
                'commune_id'=>'1'
            ],
            [
                'name' => 'User713',
                'email' => 'user13@gmail.com',
                'password' => bcrypt('admin123'),
                'birthday' => '1999-1-1',
                'first_name'=> 'vue',
                'last_name' => 'huyenytu',
                'reset_password' => bcrypt('admin123'),
                'status' => '1',
                'flag_delete'=> '1',
                'province_id'=>'1',
                'district_id'=>'1',
                'commune_id'=>'1'
            ],
            [
                'name' => 'User14',
                'email' => 'user14@gmail.com',
                'password' => bcrypt('admin123'),
                'birthday' => '1999-1-1',
                'first_name'=> 'vut',
                'last_name' => 'huyentyn',
                'reset_password' => bcrypt('admin123'),
                'status' => '1',
                'flag_delete'=> '1',
                'province_id'=>'1',
                'district_id'=>'1',
                'commune_id'=>'1'
            ]
        ]);

    }
}
