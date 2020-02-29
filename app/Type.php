<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table='type';   //表名
    protected $primaryKey='t_id'; //id
    public $timestamps=false; //时间
    //黑名单
    protected $guarded =[];
}
