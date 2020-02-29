<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pople extends Model
{
    protected $table='pople';   //表名
    protected $primaryKey='id'; //id
    public $timestamps=false; //时间
    //黑名单
    protected $guarded =[];
}
