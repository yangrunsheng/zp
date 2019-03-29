<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use App\Model\Pormissions;


class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        $params = $request->all();
//        dd($params);
        //判断用户是否登录
        $session = $request->session();
        if(!$session->has('user')){//如果用户为登陆，跳到登录页面
            return redirect('/admin/login')->send();
        }
        View::share('username',$session->get('user.username'));
        View::share('user_pic',$session->get('user.image_url'));

        //左侧视图的共享
        $user = $session->get('user');
        View::share('menus',Pormissions::getMenus($user));
        return $next($request);
    }
}
