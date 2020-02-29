<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Huo extends Model
{
    protected $table='huo';   //表名
    protected $primaryKey='h_id'; //id
    public $timestamps=false; //时间
    //黑名单
    protected $guarded =[];
}
