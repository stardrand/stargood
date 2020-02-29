<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Goods;
use Validator;
use Illuminate\Validation\Rule;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $g_name=request()->g_name??'';
        $where=[];
        if($g_name){
            $where[]=['g_name','like',"%$g_name%"];
        }
        $pageSize=config('app.pageSize');
        $res=Goods::leftjoin('type','goods.t_id','=','type.t_id')
                    ->leftjoin('cartgory','goods.t_id','=','cartgory.id')
                    ->where($where)
                    ->paginate($pageSize);
        // dd($res); 
        foreach($res as $k=>$v){
            $data=explode('|',$v['g_imgs']);
            $v['g_imgs']=$data;
        }
            
        // dd($res);
        return view('goods.index',['res'=>$res,'g_name'=>$g_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        // dd(1);
        $res=\DB::table('cartgory')->get();
        // dd($res);
        $data=\DB::table('type')->get();
        $data =typeconff($data);
        return view('goods.create',['res'=>$res,'data'=>$data]);
    }

    //添加ajax
    public function add()
    {   
        $g_name=request()->g_name;
        $g_id=request()->g_id??'';
        $where=[];
        if($g_name){
            $where[]=['g_name','=',$g_name];
        }
        if($g_id){
            $where[]=['g_id','!=',$g_id];
        }
        // echo $title;
        $res=Goods::where($where)->count();
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

        $validator = Validator::make($res,
        [
            'g_name'=>'unique:goods|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]{1,}$/u',
            'g_pirate'=>'required|integer',
            'g_repertory'=>'required|integer',
        ],[
            'g_name.unique'=>'该商品已存在',
            'g_name.regex'=>'商品名称只能使用中文、数字、字母、下滑线且不为空',
            'g_pirate.required'=>'价格不能为空',
            'g_pirate.integer'=>'价格只能使用数字',
            'g_repertory.required'=>'库存不能为空',
            'g_repertory.integer'=>'库存只能使用数字',
        ]);
        if ($validator->fails()){
            return redirect('goods/create')
                ->withErrors($validator)
                ->withInput();
        }
        
        // dd($res);
        if($request->hasFile('g_img')){
            $res['g_img']=upload('g_img');
        }
        //多文件
        // if($request->hasFile('g_imgs')){
        //     $arr=uploads('g_imgs');
        //     $arr=implode('|',$arr);
        //     $arr=rtrim($arr,'|');
        //     $res['g_imgs']=$arr;
        // }

        //多文件
        if(isset($res['g_imgs'])){
            $photos=Moreuploads('g_imgs');
            $res['g_imgs']=implode('|',$photos);
        }
        $res['g_art']=time().rand(000000,999999);
        // dd($res);
        $data=Goods::create($res);
        if($data){
            return redirect('goods');
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
        $res=\DB::table('cartgory')->get();
        // dd($res);
        $data=\DB::table('type')->get();
        $date =typeconff($data);
        // dd($date);
        $ret=Goods::find($id);
        
        $ret['g_imgs']=explode('|',$ret['g_imgs']);
        
        return view('goods.edit',['res'=>$res,'date'=>$date,'ret'=>$ret]);
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

        $validator = Validator::make($res,
        [
            'g_name'=>[Rule::unique('goods')->ignore($id,'g_id'),'regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9]{1,}$/u'],
            'g_pirate'=>'required|integer',
            'g_repertory'=>'required|integer',
        ],[
            'g_name.unique'=>'该商品已存在',
            'g_name.regex'=>'商品名称只能使用中文、数字、字母、下滑线且不为空',
            'g_pirate.required'=>'价格不能为空',
            'g_pirate.integer'=>'价格只能使用数字',
            'g_repertory.required'=>'库存不能为空',
            'g_repertory.integer'=>'库存只能使用数字',
        ]);
        if ($validator->fails()){
            return redirect('goods/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }
        
        // dd($res);
        if($request->hasFile('g_img')){
            $res['g_img']=upload('g_img');
        }
        //多文件
        // if($request->hasFile('g_imgs')){
        //     $arr=uploads('g_imgs');
        //     $arr=implode('|',$arr);
        //     $arr=rtrim($arr,'|');
        //     $res['g_imgs']=$arr;
        // }

        //多文件
        if(isset($res['g_imgs'])){
            $photos=Moreuploads('g_imgs');
            $res['g_imgs']=implode('|',$photos);
        }
        // dd($res);
        $data=Goods::where('g_id',$id)->update($res);
        if($data!==false){
            return redirect('goods');
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
           $date=Goods::destroy($id);
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
