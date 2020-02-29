<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartgory extends Model
{
    protected $table='cartgory';   //表名
    protected $primaryKey='id'; //id
    public $timestamps=false; //时间
    //黑名单
    protected $guarded =[];
}
