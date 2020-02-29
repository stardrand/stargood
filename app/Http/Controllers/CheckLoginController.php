<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Login;
use App\Http\Requests\StorePople;
class CheckLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function logindo(Request $request)
    {
        $res=$request->except('_token');
        $res['pwd']=md5($res['pwd']);
        $data=Login::where($res)->first();
        if($data){
            session(['admin'=>$data]);
            $request->session()->save();
            // return redirect('/pople');
            return redirect('/article');
        }
        return redirect('/login')->with('msg','操作错误');
    }
}
