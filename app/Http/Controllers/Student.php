<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Illuminate\Validation\Rule;
class Student extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // echo '123';
        $username=request()->username??'';
        $class=request()->class??'';
        $where=[];
        if($username){
            $where[]=['username','like',"%$username%"];
        }
        if($class){
            $where[]=['class','like',"%$class%"];
        }
        $pageSize=config('app.pageSize');
        $data=DB::table('student')->where($where)->paginate($pageSize);
        // dd($data);
        return view('student.index',['data'=>$data,'username'=>$username,'class'=>$class]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
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
        // dd($data);
        $validator = Validator::make($data,
        [
            'username'=>'required|unique:student|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9]{2,12}$/u',
            'sex'=>'required|integer|min:1|max:2',
            'ceng'=>'required|integer|between:1,100'
        ],[
            'username.required'=>'姓名不能为空',
            'username.unique'=>'姓名已存在',
            'username.regex'=>'姓名由中文、数字、字母、下划线组成',
            'sex.integer'=>'性别必须为数字',
            'ceng.required'=>'成绩不能为空',
            'ceng.integer'=>'成绩必须为数字',
            'ceng.between'=>'成绩必须为在1-100中间'
        ]);
        if ($validator->fails()){
            return redirect('student/create')
                ->withErrors($validator)
                ->withInput();
        }
        //判断文件是否存在
        if($request->hasFile('simg')){
            // $img=$this->upload('head');
            // dd($img);
            $data['simg']=$this->upload('simg');
        }
        $res=DB::table('student')->insert($data);
        if($res){
            return redirect('student');
        }
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $res=DB::table('student')->where('u_id',$id)->first();
        // dd($res);
        return view('student.edit',['res'=>$res]);
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
            'username'=>['required',Rule::unique('student')->ignore($request->id,'u_id'),'regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9]{2,12}$/u'],
            'sex'=>'required|integer|min:1|max:2',
            'ceng'=>'required|integer|between:1,100'
        ],[
            'username.required'=>'姓名不能为空',
            'username.unique'=>'姓名已存在',
            'username.regex'=>'姓名由中文、数字、字母、下划线组成',
            'sex.integer'=>'性别必须为数字',
            'ceng.required'=>'成绩不能为空',
            'ceng.integer'=>'成绩必须为数字',
            'ceng.between'=>'成绩必须为在1-100中间'
        ]);
        if ($validator->fails()){
            return redirect('student/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }
        // dd($res);
        if($request->hasFile('simg')){
            // $img=$this->upload('head');
            // dd($img);
            $res['simg']=$this->upload('simg');
        }
        $data=DB::table('student')->where('u_id',$id)->update($res);
        if($res!==false){
            return redirect('student');
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
        $res=DB::table('student')->where('u_id',$id)->delete();
        if($res){
            return redirect('student');
        }
    }
}
