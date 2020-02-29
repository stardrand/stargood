<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IndexUser;

use Validator;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;

use App\Mail\SendCode;      //邮箱
use Illuminate\Support\Facades\Mail;
class IndexUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data=$request->except('_token');
        // dd($data);
        $validator = Validator::make($data,
        [
            'u_name'=>'required',
            'u_pwd'=>'required',
        ],[
            'u_name.required'=>'账号不能为空',
            'u_pwd.required'=>'密码不能为空',

        ]);
        if ($validator->fails()){
            return redirect('login')
                ->withErrors($validator)
                ->withInput();
        }
        $res=IndexUser::where(['u_name'=>$data['u_name']])->first();
        // dd($res);
        if(empty($res)){
            return redirect('login')->with('u_name','账号或密码错误');
        }else{
            $res['u_pwd']=decrypt($res['u_pwd']);
            if($data['u_pwd']!=$res['u_pwd']){
                return redirect('login')->with('u_name',"账号或密码错误");
            }else{
                session(['u_id'=>$res['u_id']]);
                // dd($ret);
                $request->session()->save();
                // dd($request->session()->all());
                return redirect('/');
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    //邮箱发送
    public function sendemail(){
        $email='461825161@qq.com';
        $res=Mail::to($email)->send(new SendCode());
        dd($res);
    }

    //短信发送
    public function sms(){
        $code=rand(100000,999999);
        $tel=request()->u_name;
        // echo $code,$tel;
        $res=$this->sends($tel,$code);
        print_r($res);
        if($res['Code']=='OK'){
            session(['code'=>$code]);
            request()->session()->save();
            echo json_encode(['code'=>'00000','msg'=>'ok',]);die;
        }
        echo json_encode(['code'=>'00001','msg'=>'no',]);die;
    }
    //发送短信
    public function sends($tel,$code){
        AlibabaCloud::accessKeyClient('LTAI4FdooVvY4dKkbZgTbiPa', 'zHneN4s11iwK6ZrLWoDQEdOnQNhvmY')
                        ->regionId('cn-hangzhou')
                        ->asDefaultClient();

            try {
                $result = AlibabaCloud::rpc()
                                    ->product('Dysmsapi')
                                    // ->scheme('https') // https | http
                                    ->version('2017-05-25')
                                    ->action('SendSms')
                                    ->method('POST')
                                    ->host('dysmsapi.aliyuncs.com')
                                    ->options([
                                                    'query' => [
                                                    'RegionId' => "cn-hangzhou",
                                                    'PhoneNumbers' =>$tel,
                                                    'SignName' => "长茗河",
                                                    'TemplateCode' => "SMS_181855102",
                                                    'TemplateParam' => "{code:$code}",
                                                    ],
                                                ])
                                    ->request();
                return $result->toArray();
            } catch (ClientException $e) {
                return $e->getErrorMessage();
            } catch (ServerException $e) {
                return $e->getErrorMessage();
            }
        
     }

    
    //ajax
    public function add(){
        $u_name=request()->u_name;
        $res=IndexUser::where(['u_name'=>$u_name])->count();
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
            'u_name'=>'unique:indexuser',
        ],[
            'u_name.unique'=>'账号已存在',
        ]);
        if ($validator->fails()){
            return redirect('reg')
                ->withErrors($validator)
                ->withInput();
        }
        $aa=session('code');
        // dd($aa);
        if($res['code']!=session('code')){
            // dd(1);
            return  redirect('/reg')->with('msg','验证码错误');
        }
        // $ret=IndexUser::where(['u_name'=>$res['u_name']])->count();
        // dd($res);
        unset($res['code']);
        // dd($res);
        if($res['u_pwd']!=$res['u_pwds']){
            return redirect('/reg')->with('两次输入密码不一致');
        }else{
            unset($res['u_pwds']);
            $res['u_pwd']=encrypt($res['u_pwd']);
            $rew=IndexUser::create($res);
            
            return redirect('/');
            
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
