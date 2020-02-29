<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Goods;
use App\Type;
use App\Cartgory;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
class IndexController extends Controller
{
    public function index(){
        $res=cache('res');
        if(!$res){
            $res=Type::where(['p_id'=>0])->get(); //顶级分类
            cache(['res'=>$res],60*60*24);
        }
        $rew=cache('rew');
        if(!$rew){
            $rew=Goods::where(['is_shi'=>1])->get();//在首页展示的商品
            cache(['rew'=>$rew],60*60*24);
        }
        
        // dd($res);
        return view('index.index',['res'=>$res,'rew'=>$rew]);
    }
    public function setCookie(){
        return response('欢迎来到 Laravel 学院')->cookie('name','123',3);
    }

    public function sms(){
        $code=rand(100000,999999);
        $tel=request()->u_name;
        // echo $code,$tel;
        $res=$this->sends($tel,$code);
        print_r($res);
        if($res['Code']=='ok'){
            session(['code'=>$code]);
            request()->session()->save();
            
            echo '发送成功';
        }
    }
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
}
