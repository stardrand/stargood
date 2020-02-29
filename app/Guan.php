<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guan extends Model
{
    protected $table='guan';   //表名
    protected $primaryKey='u_id'; //id
    public $timestamps=false; //时间
    //黑名单
    protected $guarded =[];
}
