<?php

use Illuminate\Database\Seeder;

class InitPormissions extends Seeder
{
    /**
     * Run the database seeds.
     *初始化权限表
     * @return void
     */
    public function run()
    {
        //插入系统设置
        DB::table('pormissions')->insert([
            'fid'=>0,
            'name'=>'首页',
            'url'=>'admin.home',
            'is_menu'=>'1',
        ]);
        DB::table('pormissions')->insert([
            'fid'=>0,
            'name'=>'系统设置',
            'url'=>'#',
            'is_menu'=>'1',
        ]);
        DB::table('pormissions')->insert([
            'fid'=>2,
            'name'=>'权限列表',
            'url'=>'admin.pormission.list',
            'is_menu'=>'1',
        ]);
        DB::table('pormissions')->insert([
            'fid'=>2,
            'name'=>'权限添加',
            'url'=>'admin.pormission.create',
            'is_menu'=>'1',
        ]);
        DB::table('pormissions')->insert([
            'fid'=>2,
            'name'=>'执行权限添加',
            'url'=>'admin.pormission.doCreate',
            'is_menu'=>'2',
        ]);
    }
}
