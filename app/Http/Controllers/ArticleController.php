<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $title=request()->title??'';
        $type=request()->type??'';
        $where=[];
        if($title){
            $where[]=['title','like',"%$title%"];
        }
        if($type){
            $where[]=['type','=',"$type"];
        }
        $pageSize=config('app.pageSize');
        $res=Article::where($where)->paginate($pageSize);
        // dd($res);
        return view('article.index',['res'=>$res,'title'=>$title,'type'=>$type]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('article.create');
    }



    public function add()
    {
        $title=request()->title;
        // echo $title;
        $res=Article::where(['title'=>$title])->count();
        // echo $res;
        echo json_encode(['code'=>'00000','msg'=>'ok','count'=>$res]);

    }

    public function adds()
    {
        $title=request()->title;
        $id=request()->id;
        // echo $title;
        $where=[
            ['title','=',$title],
            ['id','!=',$id]
        ];

        $res=Article::where($where)->count();
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
        $data=$request->except('_token');
        //验证
        $validator = Validator::make($data,
        [
            'title'=>'required|unique:article|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]{2,12}$/u',
            'type'=>'required|min:1|max:200'
        ],[
            'title.required'=>'文章标题不能为空',
            'title.unique'=>'文章标题已存在',
            'title.regex'=>'文章标题只能使用中文、数字、字母、下滑线',
            'type.required'=>'文章分类不能为空',
        ]);
        if ($validator->fails()){
            return redirect('article/create')
                ->withErrors($validator)
                ->withInput();
        }
        //文件
        if($request->hasFile('img')){
            $data['img']=$this->upload('img');
        }
        $data['time']=time();
        // dd($data);
        $res=Article::create($data);
        if($res){
            return redirect('article');
        }
    }

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
    public function show()
    {
        $title=request()->title??'';
        $type=request()->type??'';
        $where=[];
        if($title){
            $where[]=['title','like',"%$title%"];
        }
        if($type){
            $where[]=['type','=',"$type"];
        }
        // Cache::flush();
        $page=request()->page??1;
        // $res=cache('res'.$page.$title.$type);
        $res=Redis::get('res'.$page.$title.$type);
        // dd($res);
        if(!$res){
            echo '库';
            $pageSize=config('app.pageSize');
            $res=Article::where($where)->paginate($pageSize);
            // $res=Article::where($where)->paginate(3);
            $res=serialize($res);
            Redis::setex('res'.$page.$title.$type,60,$res);
            // cache(['res'.$page.$title.$type=>$res],60*60);
        }

        $res=unserialize($res);
        if(request()->aiax){
            return view('article.ajax',['res'=>$res,'title'=>$title,'type'=>$type]);
        }
        return view('article.show',['res'=>$res,'title'=>$title,'type'=>$type]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $res=Article::find($id);
        // dd($res);
        return view('article.edit',['res'=>$res]);
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
        $data=$request->except('_token');
        //验证
        $validator = Validator::make($data,
        [
            'title'=>['required',Rule::unique('article')->ignore($id),'regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9]{2,12}$/u'],
            'type'=>'required|min:1|max:200'
        ],[
            'title.required'=>'文章标题不能为空',
            'title.unique'=>'文章标题已存在',
            'title.regex'=>'文章标题只能使用中文、数字、字母、下滑线',
            'type.required'=>'文章分类不能为空',
        ]);
        if ($validator->fails()){
            return redirect('article/create')
                ->withErrors($validator)
                ->withInput();
        }
        //文件
        if($request->hasFile('img')){
            $data['img']=$this->upload('img');
        }
        $res=Article::where('id',$id)->update($data);
        if($res!==false){
            return redirect('article');
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
        $res=Article::destroy($id);
        // dd($res);
        if($res){
            return redirect('article');
        }
    }

    public function del(){   
        $id=request()->id;
        $res=Article::destroy($id);
        // dd($res);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
}
