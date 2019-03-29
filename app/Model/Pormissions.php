<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Tools\ToolsAdmin;
class Pormissions extends Model
{
    //指定表
    protected $table = "Pormissions";

    const
        IS_MENU = 1,
        IS_NO_MENU = 2,
        END = true;

    /**
     * @return array
     * 获取左侧菜单得权限数据
     */

    public static function getMenus($user = []){
//        $user = [1234];
        $pormissions = self::select('id','fid','name','url')->where('is_menu',self::IS_MENU)->orderBy('sort')->get()->toArray();
//        dd($user);
        if($user['is_super']!=2){
            $pids=ToolsAdmin::getUserPormissionIds($user['user_id']);
            $pormissions = self::select('id','fid','name','url')
                ->whereIn('id',$pids)
                ->where('is_menu',self::IS_MENU)
                ->orderBy('sort')
                ->get()
                ->toArray();
        }
        $leftmenus = ToolsAdmin::buildTree($pormissions);
        return $leftmenus;
    }

    public static function getAllPormissions()
    {
        $pormissions = self::select('id','fid','name','url')
            ->orderBy('sort')
            ->get()
            ->toArray();
        $pormissions = ToolsAdmin::buildTree($pormissions);
        return $pormissions;
    }

    /**
     * 获取权限列表
     * @return array
     */
    public static function getListByFid($fid=0)
    {
        $list = self::select('id','fid','name','url','is_menu','sort')->where('fid',$fid)->orderBy('sort')->get()->toArray();
        return $list;
    }

    public static function addRecord($data)
    {
        return self::insert($data);
    }
    /**
     * 删除列表
     */
    public static function delRecord($id)
    {
        return self::where('id',$id)->delete();
    }
    /**
     * 通过权限的之间id获取权限的url得知集合
     */
    public static function getUrlsById($pids)
    {
        $pormissions = self::select('url')
            ->whereIn('id',$pids)
            ->get()
            ->toArray();
        $urls = [];
        foreach($pormissions as $key =>$value){
            $urls[] = $value['url'];
        }
        return $urls;
    }
}
