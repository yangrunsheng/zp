<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Pormissions;

class PormissionController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     *权限列表页面
     */
    public function list()
    {
        return view('admin.pormission.list');
    }

    /**
     * @param int $fid
     * @return string
     * 获取权限列表
     */
    public function getPormissionList($fid=0)
    {
        $return = [
            'code' => 2000,
            'msg' => '获取列表成功',
            'data' =>[]
        ];
        $list = Pormissions::getListByFid($fid);//获取权限列表
//        dd($list);
        $return['data'] = $list;
        return json_encode($return);
    }
    //添加页面权限
    public function create()
    {
        $list = Pormissions::getListByFid();
//        dd($list);
        return view('admin.pormission.create',['pormissions'=>$list]);
    }
    //执行添加功能
    public function doCreate(Request $request)
    {
        $params = $request->all();
        $data = [
            'fid' =>$params['fid'],
            'name'=>$params['name'],
            'url'=>$params['url'],
            'is_menu'=>$params['is_menu'],
            'sort'=>$params['sort']
        ];
        $res = Pormissions::addRecord($data);//执行添加操作
        if($res){
            return redirect('/admin/pormission/list');
        }else{
            return redirect()->back();
        }
    }

    public function del($id)
    {
        $res = Pormissions::delRecord($id);
        if($res){
            $return = [
                'code'=>2000,
                'msg'=>'删除成功',
            ];
//            return redirect('admin/pormission/list');
        }else{
            $return = [
                'code'=>4000,
                'msg'=>'删除失败',
            ];
        }
        return json_encode($return);
    }
}
