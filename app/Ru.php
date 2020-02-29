<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ru extends Model
{
    protected $table='ru';   //表名
    protected $primaryKey='r_id'; //id
    public $timestamps=false; //时间
    //黑名单
    protected $guarded =[];
}
