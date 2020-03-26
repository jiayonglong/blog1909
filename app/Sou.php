<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sou extends Model
{
      //指定表面
    protected $table = 'sou';
    protected $primaryKey = 'id';
    public $timestamps = false;

    //黑名单
    protected $guarded = [];
}
