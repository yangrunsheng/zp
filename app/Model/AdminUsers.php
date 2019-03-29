<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdminUsers extends Model
{
    //指定数据表名字
    protected $table = "admin_users";
    public $timestamps = true;

    /**
     * @param $username
     * 通过用户名获取用户
     * @param $username
     * @return array
     */
    public static function getUserByName($username){
        $userInfo = self::where('username',$username)->where('status',1)->first();
        return $userInfo;
    }
    /**
     * @params $id
     * @return array
     */
    public static function getUserById($id)
    {
        $userInfo = self::where('id',$id)->first();
        return $userInfo;
    }
    /**
     * 用户保存
     * @params $data array
     * @return array
     */
    public function addRecord($data)
    {
        return self::insert($data);
    }
    /**
     * 修改用户信息
     */
    public function updateUser($data, $id)
    {
        return self::where('id',$id)->update($data);
    }
    /**
     * 获取最新id
     */
    public function getMaxId()
    {
        return self::select('id')->orderBy('id','desc')->first();
    }
    /**
     * 汇过去用户列表信息
     */
    public static function getList()
    {
        return self::paginate(2);
    }
    /**
     * 用户删除
     */
    public static function del($id)
    {
        return self::where('id',$id)->delete();
    }
}
