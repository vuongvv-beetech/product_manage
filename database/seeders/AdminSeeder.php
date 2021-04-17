<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                'name' => 'Minh',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin123'),
                'birthday' => '1999-1-1',
                'first_name'=> 'vu',
                'last_name' => 'ha',
                'reset_password' => bcrypt('admin123'),
                'status' => '1',
                'flag_delete'=> '1',
            ]
        ]);
    }
}
