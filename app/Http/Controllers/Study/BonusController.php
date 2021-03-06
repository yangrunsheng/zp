<?php

namespace App\Http\Controllers\Study;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Study\BsBonus;
use App\Study\BsBonusRecord;
use Log;

class BonusController extends Controller
{
    public function index(){

    }

    /**
     * @param Request $request
     * 1，判断红包id和user_id是否传递
     * 2，判断一下红包是否存在
     * 3，判断红包是否已经抢完
     * 4，判断是否是最后一个人强红包
     */

    public function getBonus(Request $request)
    {
        //获取所有参数
        $params = $request->all();
        $return = [
            'code' =>2000,
            'msg'  =>'成功'
        ];
        //用户id
        if(!isset($params['user_id']) || empty($params['user_id'])){
            $return = [
                'code' =>4001,
                'msg'  =>'用户没有登录'
            ];
            return json_encode($return);
        }
        //红包id
        if(!isset($params['bonus_id']) || empty($params['bonus_id'])){
            $return = [
                'code' =>4002,
                'msg'  =>'请选择指定的红包'
            ];
            return json_encode($return);
        }
        //检测红包是否存在
        $bonus = BsBonus::getBonusInfo($params['bonus_id']);
        if(empty($bonus)){
            $return = [
                'code' =>4003,
                'msg'  =>'红包不存在'
            ];
            return json_encode($return);
        }
//        dd($bonus);
        $record = BsBonusRecord::getRecordById($params['user_id'],$params['bonus_id']);
//        dd($record);
        if($record){
            //dd($record);
             $return = [
                 'code' =>4005,
                 'msg'  =>'你已经抢过该红包了'
             ];
             return json_encode($return);
        }
       // 红包是否被抢光
        if($bonus->left_amount<=0 || $bonus->left_nums<=0){
//            dd($bonus->left_amoun);
            $return = [
                'code' =>4004,
                'msg'  =>'红包被抢光'
            ];
            return json_encode($return);
        }
        //是否是最后一个红包
        //dd($bonus);
        if($bonus->left_nums ==1){
            Log::info('最后一个红包，抢到的人的id'.$params['user_id']);
            //用户抢到的金额
            $getMoney = $bonus->left_amount;
//            dd($getMoney);
            //插入一条bonus_record记录
            $data = [
                'user_id' =>$params['user_id'],
                'bonus_id'=>$params['bonus_id'],
                'money'   =>$getMoney,
                'flag'    =>1
            ];
            BsBonusRecord::createRecord($data);

            //更新红包的数据
            $data1 = [
                'left_amount' => 0,
                'left_nums'   =>0
            ];
            BsBonus::updateBonusInfo($data1,$params['bonus_id']);
            //评出最佳手气
            //1，降序排列红包的记录
            $res = BsBonusRecord::getMaxBonus($params['bonus_id']);
            //2，更新抢红包的记录
            BsBonusRecord::updateBonusRecord(['flag'=>2],$res->id);
        }else{
            $min = 0.01;//最小金额
            $max = $bonus->left_amount - ($bonus->left_nums -1)*0.01;//最大金额
            $getMoney = rand($min*100,$max*100)/100;//获取金额随机值
            $data = [
                'user_id' =>$params['user_id'],
                'bonus_id'=>$params['bonus_id'],
                'money'   =>$getMoney,
                'flag'    =>1
            ];
            BsBonusRecord::createRecord($data);
            //更新红包的金额
            $data1 = [
                'left_amount' =>$bonus->left_amount - $getMoney,
                'left_nums'   =>$bonus->left_nums -1
            ];
            BsBonus::updateBonusInfo($data1,$params['bonus_id']);
        }
    }
}
