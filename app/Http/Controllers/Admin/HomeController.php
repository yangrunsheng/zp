<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //后台首页
    public function home(){
//        dd(\App\Model\Pormissions::getMenus());
//         \Route::has('admin.home') ? route('admin.home'):'没有';
//        echo \Route::currentRouteName();exit;
        return view('admin.home');
    }
}
