<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if(!session('u_id')){
            return view('index.login');
        }
        $u_id=session('u_id');
        $ret=Cart::count();
        $res=Cart::leftjoin('goods','Cart.g_id','=','goods.g_id')->where(['u_id'=>$u_id])->get();
        return view('index.cart',['res'=>$res,'ret'=>$ret]);
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
    public function show(Request $request)
    {
        $data=$request->except('_token');
        // dd($data);
        if(!session('u_id')){
            echo json_encode(['code'=>'1','msg'=>'未登录无法添加',]);die;
            return;die;
        }
        $data['u_id']=session('u_id');
        $rew=Cart::where(['g_id'=>$data['g_id'],'u_id'=>$data['u_id']])->first();
        if(empty($rew)){
            $data['c_time']=time();
            $res=Cart::create($data);
            if($res){
                echo json_encode(['code'=>'0','msg'=>'ok',]);die;
            }else{
                echo json_encode(['code'=>'1','msg'=>'放入失败',]);die;
            }
        }else{
            $res=['g_id'=>$data['g_id'],'c_num'=>$data['c_num']+$rew['c_num'],'u_id'=>$data['u_id']];
            $req=Cart::where(['g_id'=>$data['g_id'],'u_id'=>$data['u_id']])->update($res);
            if($req){
                echo json_encode(['code'=>'0','msg'=>'ok',]);die;
            }else{
                echo json_encode(['code'=>'1','msg'=>'放入失败',]);die;
            }
        }

        
        // print_r($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
