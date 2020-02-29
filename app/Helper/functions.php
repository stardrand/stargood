<?php
/**
 * 公用的方法  返回json数据，进行信息的提示
 * @param $status 状态
 * @param string $message 提示信息
 * @param array $data 返回数据
 */
function showMsg($status,$message = '',$data = array()){
    $result = array(
        'status' => $status,
        'message' =>$message,
        'data' =>$data
    );
    exit(json_encode($result));
}


//无限极
function typeconff($data,$p_id=0,$level=0){
    if(!$data){
        return ;
    }
    static $atr=[];
    foreach($data as $k=>$v){
        if($v->p_id==$p_id){
            $v->level=$level;
            $atr[]=$v;

            typeconff($data,$v->t_id,$level+1);
        }
    }
    return $atr;
}


 /**
     * 上传文件
     */
    function upload($filename){
        //判断上传中有误错误
        if (request()->file($filename)->isValid()){
            //接受值
            $photo = request()->file($filename);
            //上传位置
            $store_result = $photo->store('uploads');
            return $store_result;
        }
    }

    //多文件
    function uploads($filename)
    {   
        $data=request()->file($filename);
        foreach($data as $k => $v)
        {
            $arr[$k] = $v->store('uploads');
        }
        return $arr;
    }



    //多个文件上传
    function Moreuploads($filename){
        $photo = request()->file($filename);
        if(!is_array($photo)){
          return;
        } 
       
        foreach( $photo as $v ){
           if ($v->isValid()){
             $store_result[] = $v->store('uploads');
           }
        }
          
        return $store_result;
     }


     //短信
    //  use AlibabaCloud\Client\AlibabaCloud;
    //  use AlibabaCloud\Client\Exception\ClientException;
    //  use AlibabaCloud\Client\Exception\ServerException;
     function sends($tel,$code){
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
                                                    'PhoneNumbers' => $tel,
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