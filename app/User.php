<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
     //指定表面
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    //黑名单
    protected $guarded = [];
}