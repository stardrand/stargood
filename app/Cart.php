<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table='cart';   //表名
    protected $primaryKey='c_id'; //id
    public $timestamps=false; //时间
    //黑名单
    protected $guarded =[];
}
