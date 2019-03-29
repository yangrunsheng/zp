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


    //作者列表
    Route::get('author/list','Admin\AuthorController@list')->name('admin.author.list');
    //浊者添加
    Route::get('author/create','Admin\AuthorController@create')->name('admin.author.create');
    //作者执行添加
    Route::post('author/store','Admin\AuthorController@store')->name('admin.author.store');
    //作者删除
    Route::get('author/del/{id}','Admin\AuthorController@del')->name('admin.author.del');


    //分类列表
    Route::get('category/list','Admin\CategoryController@list')->name('admin.category.list');
    //执行小说添加
    Route::get('category/create','Admin\CategoryController@create')->name('admin.category.create');
    //执行分类添加
    Route::post('category/store','Admin\CategoryController@store')->name('admin.category.store');
    //分类删除
    Route::get('category/del/{id}','Admin\CategoryController@del')->name('admin.category.del');


    //小说添加
    Route::get('novel/create','Admin\NovelController@create')->name('admin.novel.create');
    //执行小说添加
    Route::post('novel/store','Admin\NovelController@store')->name('admin.novel.store');
    //小说列表
    Route::get('novel/list','Admin\NovelController@list')->name('admin.novel.list');
    //小说编辑
    Route::get('nove/edit/id{}','Admin\NovelController@edit')->name('admin.novel.edit');
    //执行小说编辑
    Route::post('nove/doEdit'.'Admin\NovelController@doEdit')->name('admin.nove.doEdit');
    //小说删除
    Route::get('novel/del/{id}','Admin\NovelController@del')->name('admin.novel.del');


    //添加小说章节页面
    Route::get('chapter/add/{novel_id}','Admin\ChapterController@create')->name('admin.chapter.create');
    //保存小说的章节
    Route::post('chapter/store','Admin\ChapterController@store')->name('admin.chapter.store');
    //小说章节列表
    Route::get('chapter/list/{novel_id?}','Admin\ChapterController@list')->name('admin.chapter.list');
    //章节删除
    Route::get('chapter/del/{id}','Admin\ChapterController@del')->name('admin.chapter.del');
    //章节编辑
    Route::get('chapter/edit/{id}','Admin\ChapterController@edit')->name('admin.chapter.edit');
    //执行章节编辑
    Route::post('chapter/doEdit','Admin\ChapterController@doEdit')->name('admin.chapter.doEdit');


    //小说评论列表页面
    Route::get('novel/comment/list','Admin\CommentController@list')->name('admin.novel.comment.list');
    //小说数据
    Route::get('novel/comment/data','Admin\CommentController@getComment')->name('admin.novel.comment.data');
    //小说评论审核
    Route::get('novel/comment/check/{id}','Admin\CommentController@check')->name('admin.novel.comment.check');
    //小说评论删除
    Route::get('novel/comment/del/{id}','Admin\CommentController@del')->name('admin.novel.comment.del');
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
