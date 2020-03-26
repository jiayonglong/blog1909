<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
     //指定表面
    protected $table = 'goods';
    protected $primaryKey = 'goods_id';
    public $timestamps = false;

    //黑名单
    protected $guarded = [];

    //获取首页幻灯片数据
    public static function getSlideDate(){
        $is_huan =is_huan::select('goods_id','goods_img')->where('is_huan',1)->orderBy('goods_id','desc')->take(5)->get();
        return $is_huan;
    }
}
