<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cartgory;
class CartgoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res=Cartgory::get();
        // dd($res);
        return view('cartgory.index',['res'=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *添加
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cartgory.create');
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
        if($request->hasFile('logo')){
            $data['logo']=$this->upload('logo');
        }
        $res=Cartgory::insert($data);
        if($res){
            return redirect('cartgory');
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
        $res=Cartgory::find($id);
        // dd($res);
        return view('cartgory.edit',['res'=>$res]);
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
        if($request->hasFile('logo')){
            $data['logo']=$this->upload('logo');
        }
        $res=Cartgory::where('id',$id)->update($data);
        if($res!==false){
            return redirect('cartgory');
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
        $res=Cartgory::destroy($id);
        // dd($res);
        if($res){
            return redirect('cartgory');
        }
    }
}
