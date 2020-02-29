<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guan;
use App\Huo;
use App\Ru;
class GuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res=Guan::where(['sid'=>2])->get();
        $rew=Huo::get();
        $req=Ru::get();
        // dd($res);
        return view('guan.index',['res'=>$res,'rew'=>$rew,'req'=>$req]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('guan.create');
    }

    public function createhuo()
    {
        return view('guan.createhuo');
    }

    public function createru()
    {
        return view('guan.createru');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->except('_token');
        $res=Guan::create($data);
        if($res){
            return redirect('guan');
        } 
    }

    public function storehuo(Request $request)
    {
        $data=$request->except('_token');
        $res=Huo::create($data);
        if($res){
            return redirect('guan');
        } 
    }

    public function storeru(Request $request)
    {
        $data=$request->except('_token');
        $data['r_time']=time();
        $res=Ru::create($data);
        if($res){
            return redirect('guan');
        } 
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //登陆执行
    public function show(Request $request)
    {
        $data=$request->except('_token');
        // dd($data);
        $where=[
            'u_zh'=>$data['u_zh'],
            'u_pwd'=>$data['u_pwd'],
        ];
        $res=Guan::where($where)->first();
        // dd($res);
        if($res){
            session(['user'=>$res['sid']]);
            $request->session()->save();
            return redirect('guan');
        }
        return redirect('/reglogin')->with('msg','账号或密码错误');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $res=Guan::find($id);
        // dd($res);
        return view('guan.edit',['res'=>$res]);
    }

    public function edithuo($id)
    {
        $res=Huo::find($id);
        // dd($res);
        return view('guan.edithuo',['res'=>$res]);
    }

    public function editru($id)
    {
        $res=Ru::find($id);
        // dd($res);
        return view('guan.editru',['res'=>$res]);
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
        $res=$request->except('_token');
        $data=Guan::where('u_id',$id)->update($res);
        if($data!==false){
            return redirect('guan');
        }
    }

    public function updatehuo(Request $request, $id)
    {
        $res=$request->except('_token');
        $data=Huo::where('h_id',$id)->update($res);
        if($data!==false){
            return redirect('guan');
        }
    }

    public function updateru(Request $request, $id)
    {
        $res=$request->except('_token');
        $data=Ru::where('r_id',$id)->update($res);
        if($data!==false){
            return redirect('guan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=Guan::where('u_id',$id)->delete();
        if($res){
            return redirect('guan');
        }
    }

    public function del($id)
    {
        $res=Huo::where('h_id',$id)->delete();
        if($res){
            return redirect('guan');
        }
    }

    public function dels($id)
    {
        $res=Ru::where('r_id',$id)->delete();
        if($res){
            return redirect('guan');
        }
    }
}
