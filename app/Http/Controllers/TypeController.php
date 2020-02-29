<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use Validator;
use Illuminate\Validation\Rule;
class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $t_name=request()->t_name??'';
        $where=[];
        if($t_name){
            $where[]=['t_name','like',"%$t_name%"];
        }
        $data=Type::where($where)->get();
        $res=typeconff($data);
        return view('type.index',['res'=>$res,'t_name'=>$t_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $data=Type::get();
        $res =typeconff($data);
        return view('type.create',['res'=>$res]);
    }

    // //无限极
    // public function typeconff($data,$p_id=0,$level=0){
    //     if(!$data){
    //         return ;
    //     }
    //     static $atr=[];
    //     foreach($data as $k=>$v){
    //         if($v->p_id==$p_id){
    //             $v->level=$level;
    //             $atr[]=$v;

    //             $this->typeconff($data,$v->t_id,$level+1);
    //         }
    //     }
    //     return $atr;
    // }





    public function add()
    {   
        $t_name=request()->t_name;
        $t_id=request()->t_id??'';
        $where=[];
        if($t_name){
            $where[]=['t_name','=',$t_name];
        }
        if($t_id){
            $where[]=['t_id','!=',$t_id];
        }
        // echo $title;
        $res=Type::where($where)->count();
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
            't_name'=>'unique:type|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]{1,}$/u',
        ],[
            't_name.unique'=>'分类已存在',
            't_name.regex'=>'分类名称只能使用中文、数字、字母、下滑线且不为空',
        ]);
        if ($validator->fails()){
            return redirect('type/create')
                ->withErrors($validator)
                ->withInput();
        }
        $data=Type::create($res);
        if($res){
            return redirect('type');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        showMsg(1,'Hello World!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Type::find($id);
        $res=Type::get();
        // dd($res);
        return view('type.edit',['data'=>$data,'res'=>$res]);
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
            't_name'=>[Rule::unique('type')->ignore($id,'t_id'),'regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9]{1,}$/u']
        ],[
            't_name.unique'=>'分类已存在',
            't_name.regex'=>'分类名称只能使用中文、数字、字母、下滑线且不为空',
        ]);
        if ($validator->fails()){
            return redirect('type/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }
        $data=Type::where('t_id',$id)->update($res);
        if($data!==false){
            return redirect('type');
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
        $res=Type::where(['p_id'=>$id])->count();
        if($res>0){
            echo json_encode(['code'=>"2",'fond'=>"该分类下有子分类，无法删除"]);
            // exit;
        }else{
           $date=Type::destroy($id);
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
}
