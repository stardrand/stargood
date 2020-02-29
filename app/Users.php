<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table='users';   //表名
    protected $primaryKey='u_id'; //id
    public $timestamps=false; //时间
    //黑名单
    protected $guarded =[];
}
