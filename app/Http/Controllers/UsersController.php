<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use Validator;
use Illuminate\Validation\Rule;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $u_name=request()->u_name??'';
        $where=[];
        if($u_name){
            $where[]=['u_name','like',"%$u_name%"];
        }
        $pageSize=config('app.pageSize');
        $res=Users::where($where)
                    ->paginate($pageSize);
        return view('users.index',['res'=>$res,'u_name'=>$u_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    public function add()
    {   
        $u_name=request()->u_name;
        $g_id=request()->g_id??'';
        // $where=[];
        // if($g_name){
        //     $where[]=['g_name','=',$g_name];
        // }
        // if($g_id){
        //     $where[]=['g_id','!=',$g_id];
        // }
        // echo $title;
        $res=Users::where(['u_name'=>$u_name])->count();
        // echo $res;
        echo json_encode(['code'=>'00000','msg'=>'ok','count'=>$res]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $res=$request->except('_token');
        
        
        // $validator = Validator::make($res,
        // [
        //     'u_name'=>'unique:goods|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]{1,}$/u',
        //     'g_pirate'=>'required|integer',
        //     'g_repertory'=>'required|integer',
        // ],[
        //     'g_name.unique'=>'该商品已存在',
        //     'g_name.regex'=>'商品名称只能使用中文、数字、字母、下滑线且不为空',
        //     'g_pirate.required'=>'价格不能为空',
        //     'g_pirate.integer'=>'价格只能使用数字',
        //     'g_repertory.required'=>'库存不能为空',
        //     'g_repertory.integer'=>'库存只能使用数字',
        // ]);
        // if ($validator->fails()){
        //     return redirect('users/create')
        //         ->withErrors($validator)
        //         ->withInput();
        // }
        if($request->hasFile('u_img')){
            $res['u_img']=upload('u_img');
        };
        unset($res['u_pwds']);
        // dd($res);
        $res['u_pwd']=encrypt($res['u_pwd']);
        // dd($res);
        $data=Users::create($res);
        if($data){
            return redirect('users');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $res=Users::find($id);
        $res['u_pwd']=decrypt($res['u_pwd']);
        return view('users.edit',['res'=>$res]);
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
        if($request->hasFile('u_img')){
            $res['u_img']=upload('u_img');
        };
        unset($res['u_pwds']);
        // dd($res);
        $res['u_pwd']=encrypt($res['u_pwd']);
        // dd($res);
        $data=Users::where('u_id',$id)->update($res);
        if($data){
            return redirect('users');
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
        $date=Users::destroy($id);
        // dd($res);
        if($date){
            echo json_encode(['code'=>"1",'fond'=>"成功"]);
            // exit;
        }else{
            echo json_encode(['code'=>"2",'fond'=>"删除失败"]);
            // exit;
        } 
    }
}
