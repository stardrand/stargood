<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Goods;
use App\Type;
use App\Cartgory;
use Validator;
use Illuminate\Support\Facades\Redis;
class PorinfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $res=Type::get();
        $res=typeconff($res,$id);
        $rew=[];
        foreach($res as $k=>$v){
            $rew[]=Goods::leftjoin('type','goods.t_id','=','type.t_id')->where(['goods.t_id'=>$v['t_id']])->get();
        }
        $rew[]=Goods::leftjoin('type','goods.t_id','=','type.t_id')->where(['goods.t_id'=>$id])->get();
        // dd($rew);
        return view('index.prolist',['rew'=>$rew]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   

        
        $res=Goods::find($id);
            // dd($res);

        Redis::setnx('num'.$id,0);
        $num=Redis::incr('num'.$id);
        
        
        $res['g_imgs']=explode('|',$res['g_imgs']);
        // dd($res);
        return view('index.proinfo',['res'=>$res,'num'=>$num]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
