<?php

namespace App\Study;

use Illuminate\Database\Eloquent\Model;

class BsBonus extends Model
{
    //
    protected $table ="bs_bonus";

    /**
     * @param $id
     * @return BsBonus|Model|null
     */
    //获取红包信息
    public static function getBonusInfo($id){
        $bonus = self::where('id',$id)->first();
        return $bonus;
    }

    /**
     * @param $data
     * @param $id
     * @return bool
     * 更新红包信息
     */
    public static function updateBonusInfo($data,$id){
        return self::where('id',$id)->update($data);
    }
}
