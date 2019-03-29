<?php

namespace App\Study;

use Illuminate\Database\Eloquent\Model;

class BsBonusRecord extends Model
{
    protected $table = "bs_bonus_record";

    /**
     * @param $data
     * @return bool
     * @desc 创建一天记录
     */
    public static function createRecord($data){
        $res = self::insert($data);
        return $res;
    }

    /**
     * @param $bonus
     * 获取最金额的红包
     * @param $bonusID int
     */
    public static function getMaxBonus($bonusId){
        $res = self::select('id')->where('bonus_id',$bonusId)->orderBy('money','desc')->first();
        return $res;
    }

    /**
     * @param $data
     * @param $id
     * @return bool
     * 更新红包记录
     */
    public static function updateBonusRecord($data,$id){
        return self::where('id',$id)->update($data);
    }

    /**
     * @param $userId
     * @param $bonusId
     * @return BsBonusRecord|Model|null
     * 通过用户ID和用户ID来获取红包的记录
     */
    public static function getRecordById($userId,$bonusId){
        return self::where('user_id',$userId)->where('bonus_id',$bonusId)->first();
    }
}
