<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Pople;
use Validator;
use App\Http\Requests\StorePople;
class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data=Db::table('pople')->get();

        $uname=request()->uname??'';
        $where=[];
        if($uname){
            $where[]=['uname','like',"%$uname%"];
        }


        $pageSize=config('app.pageSize');
        $data=Pople::where($where)->paginate($pageSize);
        // $data=Pople::get();
        // dd($data);
        return view('pople.index',['data'=>$data,'uname'=>$uname]);
    }

    /**
     * Show the form for creating a new resource.
     *添加
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pople.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //第二种验证
    // public function store(StorePople $request)
    public function store(Request $request)
    {   
        //第一种验证
        // $request->validate([
        //     'uname'=>'required|unique:pople|min:2|max:12',
        //     'u_age'=>'required|integer|min:1|max:200'
        // ],[
        //     'uname.required'=>'姓名不能为空',
        //     'uname.unique'=>'姓名已存在',
        //     'u_age.required'=>'年龄不能为空',
        //     'u_age.integer'=>'年龄必须为数字',
        // ]
        // );
        $data=$request->except('_token');

        //第三种验证
        $validator = Validator::make($data,
        [
            'uname'=>'required|unique:pople|min:2|max:12',
            'u_age'=>'required|integer|min:1|max:200'
        ],[
            'uname.required'=>'姓名不能为空',
            'uname.unique'=>'姓名已存在',
            'u_age.required'=>'年龄不能为空',
            'u_age.integer'=>'年龄必须为数字',
        ]);
        if ($validator->fails()){
            return redirect('pople/create')
                ->withErrors($validator)
                ->withInput();
        }

        //文件
        if($request->hasFile('head')){
            // $img=$this->upload('head');
            // dd($img);
            $data['head']=$this->upload('head');
        }

        $data['addtime']=time();
        // $res=Db::table('pople')->insert($data);
        // $res=Pople::insert($data);
        $res=Pople::create($data);
        if($res){
            return redirect('pople');
        }
        // dd($res);
    }
    /**
     * 上传文件
     */
    public function upload($filename){
        //判断上传中有误错误
        if (request()->file($filename)->isValid()){
            //接受值
            $photo = request()->file($filename);
            //上传位置
            $store_result = $photo->store('uploads');
            return $store_result;
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
     *编辑页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $res=Db::table('pople')->where('id',$id)->first();
        // dd($res);
        return view('pople.edit',['res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *执行修改
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=$request->except('_token');
        
            if($request->hasFile('head')){
                // $img=$this->upload('head');
                // dd($img);
                $data['head']=$this->upload('head');
            }
        

        $res=Db::table('pople')->where('id',$id)->update($data);
        if($res!==false){
            return redirect('pople');
        }
    }

    /**
     * Remove the specified resource from storage.
     *删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=Db::table('pople')->where('id',$id)->delete();
        if($res){
            return redirect('pople');
        }
    }
}
