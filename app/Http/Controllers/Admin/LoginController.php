<?php

namespace App\Http\Controllers\Admin;

use app\api\controller\Ad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AdminUsers;

class LoginController extends Controller
{
    /**
     * 登录页面
     */
    public function index(Request $request){
        //       $session = $request->session()->get('user');
        $session = $request->session();
        if($session->has('user')){
            return redirect('/admin/home');
        }
        return view('admin.login');
    }

    /**
     * @param Request $request
     * 1，用用户名查询账号是否存在
     * 2，如果不存在提示用户不存在
     * 3，校验密码是否正确
     * 4，如果错误提密码错误
     */
    public function doLogin(Request $request){
        $params = $request->all();

        $return = [
            'code' => 2000,
            'msg'  =>'登录成功'
        ];
        if(!isset($params['username']) || empty($params['username'])){
            $return = [
                'code' =>4000,
                'msg' =>'用户名不能为空'
            ];
            return json_encode($return);
        }
        if(!isset($params['password']) || empty($params['password'])){
            $return = [
                'code' =>4001,
                'msg' =>'密码不能为空'
            ];
            return json_encode($return);
        }
        //通过用户名获取用户的信息
        $userInfo = AdminUsers::getUserByName($params['username']);
//        dd($userInfo);
        if(empty($userInfo)){
            $return = [
                'code' =>4003,
                'msg' =>'用户不存在'
            ];
            return json_encode($return);
        }else{
            $postPwd = md5($params['password']);
            if($postPwd !== $userInfo->password){
                $return = [
                    'code' =>4004,
                    'msg' =>'密码错误'
                ];
                return json_encode($return);
            }else{//密码正确，执行登陆
                $session = $request->session();//获取session对象

                //存储用户id
                $session->put('user.user_id',$userInfo->id);
                $session->put('user.username',$userInfo->username);
                $session->put('user.image_url',$userInfo->image_url);
                $session->put('user.is_super',$userInfo->is_super);//是否超管

                return json_encode($return);
            }
        }
    }
    public function logout(Request $request){
        //session删除
        $request->session()->forget('user');
        return redirect('admin/login');
    }
}
