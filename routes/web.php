<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('Dnf/index',function(){
   return view();
});
Route::prefix('sign')->group(function(){
   Route::get('sign','SignController@index');
});
Route::prefix('study')->group(function(){
   Route::any('get/bonus','Study\BonusController@getBonus');//获取红包的路由
});
Route::prefix('study')->group(function(){
    Route::any('get/BsBonusRecord','Study\BsBonusRecord@getRecordById');//获取红包的路由
});
//管理后台rbac功能的路由组


//登录页面
Route::get('admin/login','Admin\LoginController@index');
//执行登陆
Route::post('admin/doLogin','Admin\LoginController@doLogin');
//用户退出登录
Route::get('admin/logout','Admin\LoginController@logout');
//管理后台rbac功能类的路由组
Route::middleware('admin_auth')->prefix('admin')->group(function(){
    //管理后台首页
    Route::get('home','Admin\HomeController@home')->name('admin.home');
    //权限列表
    Route::get('/pormission/list','Admin\PormissionController@list')->name('admin.pormission.list');
    //获取权限的数据
    Route::any('/get/pormission/list/{fid?}','Admin\PormissionController@getPormissionList')->name('admin.get.pormission.list');
    //权限添加
    Route::get('/pormission/create','Admin\PormissionController@create')->name('admin.pormission.create');
    //执行权限添加
    Route::post('/pormission/doCreate','Admin\PormissionController@doCreate')->name('admin.pormission.doCreate');
    //删除权限
    Route::get('/pormission/del/{id}','Admin\PormissionController@del')->name('admin.pormission.del');


    //用户添加页面
    Route::get('/user/add','Admin\AdminUsersController@create')->name('admin.user.add');
    //执行添加用户
    Route::post('/user/store','Admin\AdminUsersController@store')->name('admin.user.store');
    //用户列表页面
    Route::get('/user/list','Admin\AdminUsersController@list')->name('admin.user.list');
    //用户删除列表
    Route::get('/user/del/{id}','Admin\AdminUsersController@delUser')->name('admin.user.del');
    //用户编辑页面
    Route::get('/user/edit/{id}','Admin\AdminUsersController@edit')->name('admin.user.edit');
    //用户执行编辑页面
    Route::post('/user/doEdit','Admin\AdminUsersController@doEdit')->name('admin.user.doEdit');


    //角色列表
    Route::get('/role/list','Admin\RoleController@list')->name('admin.role.list');
    //角色删除
    Route::get('/role/del/{id}','Admin\RoleController@delRole')->name('admin.role.del');
    //角色添加
    Route::get('/role/create','Admin\RoleController@create')->name('admin.role.create');
    //角色执行添加
    Route::post('/role/store','Admin\RoleController@store')->name('admin.role.store');
    //角色编辑
    Route::get('/role/edit/{id}','Admin\RoleController@edit')->name('admin.role.edit');
    //角色执行编辑
    Route::post('/role/doEdit','Admin\RoleController@doEdit')->name('admin.role.doEdit');
    //角色权限编辑
    Route::get('/role/pormission/{id}','Admin\RoleController@rolePormission')->name('admin.role.pormission');
    //角色权限执行编辑
    Route::post('/role/pormission/save','Admin\RoleController@saveRolePormission')->name('admin.role.pormission.save');
});
//学习猎德路由组
Route::prefix('study')->group(function(){
    Route::get('guess/add','Study\GuessController@add');
    Route::post('guess/doAdd','Study\GuessController@doAdd');
    Route::get('guess/list','Study\GuessController@list');
    Route::get('guess/guess','Study\GuessController@guess');
    Route::post('guess/doGuess','Study\GuessController@doGuess');
    Route::get('guess/result','Study\GuessController@checkResult');
});
Route::prefix('boll')->group(function(){
   Route::get('guess/add','Boll\GuessController@add');
   Route::post('guess/doAdd','Boll\GuessController@doAdd');
   Route::get('guess/list','Boll\GuessController@list');
   Route::get('guess/guess','Boll\GuessController@guess');
   Route::post('guess/doGuess','Boll\GuessController@doGuess');
});
