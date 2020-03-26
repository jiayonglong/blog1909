<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Essay extends Model
{
      //指定表面
    protected $table = 'essay';
    protected $primaryKey = 'essay_id';
    public $timestamps = false;

    //黑名单
    protected $guarded = [];
}
