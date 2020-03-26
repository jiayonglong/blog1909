<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     //指定表面
    protected $table = 'order';
    protected $primaryKey = 'order_id';
    public $timestamps = false;

    //黑名单
    protected $guarded = [];
}