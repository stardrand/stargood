<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    protected $table='admin';   //表名
    protected $primaryKey='id'; //id
    public $timestamps=false; //时间
    //黑名单
    protected $guarded =[];
}
