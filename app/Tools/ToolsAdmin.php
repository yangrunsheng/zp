<?php

namespace App\Tools;




class ToolsAdmin {
    /**
     * @param $data
     * @param int $fid
     * @return array
     * 无限极分类的数据组装
     * @param $array $data
     * @param $fid 父类id
     */
    public static function buildTree($data,$fid=0){
        if(empty($data)){
            return[];
        }
        static $menus = [];//定义一个警惕爱的变量，用来存储无限极分类数据
        foreach($data as $key =>$value){
            if($value['fid'] == $fid){//当前循环的内容中fid是否等于函数fid参数
                if(!isset($menus[$fid])){//如果数据不存在fid的key
                    $menus[$value['id']] = $value;
                }else{
                    $menus[$fid]['son'][$value['id']] = $value;
                }
                unset($data[$key]);
                self::buildTree($data,$value['id']);//执行递归调用
            }
        }
        return $menus;
    }
    /**
     * 文件上传函数
     * @param $files $object
     * @return string url
     */
    public static function uploadFile($files)
    {
        //参数为空
        if(empty($files)){
            return "";
        }
        //文件上传的目录
        $basePath = 'uploads'.date("Y-m-d",time());
        //目录不存在
        if(!file_exists($basePath)){
            @mkdir($basePath,755,true);
        }
       //文件名字
        $filename = '/'.date('YmdHis',time()).rand(0,10000).'.'.$files->extension();
        @move_uploaded_file($files->path(),$basePath.$filename);//执行文件上传
        return '/'.$basePath.$filename;
    }
    /**
     * 获取用户所有的主键id
     * 根据用户userId查询角色id
     * 根据角色id查询权限id
     */
    public static function getUserPormissionIds($userId)
    {
        if(!isset($userId) || empty($userId)){
            return [];
        }
        $userRole = new \App\Model\UserRole();
        $roles = $userRole->getByUserId($userId);//根据用户id查询角色id
        //角色id不存在
        if(empty($roles)){
            return [];
        }
        $roleP = new \App\Model\RolePormission();
        $pids = $roleP->getPormissionByRoleId($roles->role_id);//根据用户的角色id去调用权限id集合
        return $pids;
    }
    /**
     * 获取当前登录用户的所有的权限url地址
     */
    public static function getUrlsByUserId($userId)
    {
        $pids = self::getUserPormissionIds($userId);//获取所有权限节点id
        $urls = \App\Model\Pormissions::getUrlsByIds($pids);//根据权限节点id获取所有的权限的url地址
        return $urls;
    }
}