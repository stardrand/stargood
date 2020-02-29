<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Tumtit extends Controller
{
    public function index(){
        echo '哈哈哈';
    }

    public function add(){
        return view('user.add');
    }

    public function asss(Request $request){
        // echo '123';
        $name=$request->all();
        dd($name);
    }

    //作业
    //1
    function show(){
        echo '这里是商品详情页';
    }
    //4
    function adds(){
        return view('user.ass');
    }
    //5
    function aee(Request $request){
        $fid=$request->all();
        dd($fid);
    }
}
