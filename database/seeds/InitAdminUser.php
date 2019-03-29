<?php

use Illuminate\Database\Seeder;

class InitAdminUser extends Seeder
{
    /**
     * Run the database seeds.
     *初始化后台管理员用户表
     * @return void
     */
    public function run()
    {
        $data =[
            'username' =>'admin',
            'password'=>md5('123123'),
            'image_url'=>'',
            'is_super'=>'2',
            'status'=>'1'
        ];
        \Illuminate\Support\Facades\DB::table('admin_users')->insert($data);
    }
}
