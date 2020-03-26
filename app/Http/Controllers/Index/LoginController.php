<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

  use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use App\User;
//邮箱
use App\Mail\SendCode;
use Illuminate\Support\Facades\Mail;
class LoginController extends Controller
{
    public function log(){
        return view('index.login');
    }
     public function dologin(){
    	 $post = request()->except('_token');
        // dd($post);
        $user = new User();
        $user = User::where('name',$post['user_tel'])->first();
        // dd($user);
        // if($user->user_pwd != $post['user_pwd']){
        //   return redirect('/log')->with('msg','用户名或密码错误，请重新登录');
        // }
      //  dd(encrypt(123456));die;
        if(decrypt($user->user_pwd) != $post['user_pwd']){
            //  dd(decrypt($user->user_pwd));
            return redirect('/log')->with('msg','用户或密码错误');
        }
     
    
        session(['adminuser'=>$user]);
        if(isset($post['refer'])){
            return redirect($post['refer']);
        }
        return redirect('/');
     }
    
     public function reg(){
        return view('index.reg');
    }
    public function sendSMS(){
        $name =  request()->name;
        $reg = '/^1[3,5,6,7,8,9]\d{9}$/';
        if(!preg_match($reg,$name)){
            return json_encode(['code'=>'00001','msg'=>'请输入正确的手机号或验证码']);
        }
        $code = rand(100000,999999);
        $result =  $this->send($name,$code);
        if($result['Message']=='OK'){
            session(['code'=>$code]);
            return json_encode(['code'=>'0','msg'=>'发送成功']);
        }
           return json_encode(['code'=>'1','msg'=>$result['Message']]);
    }
     public function regs(){
    	 $post = request()->except(['_token','repassword']);

        $codes =  session('code');
        // if(!($post['code']==$codes)){
        //     return redirect('/reg')->with('msg','验证码错误');
        // }
        $posts = request()->except(['_token','repassword','code']);
        $posts['user_pwd'] = encrypt($posts['user_pwd']);
        $user = new User();
        $ret = User::insert($posts);
        session('code',null);
        if($ret){
            return redirect('/log');
        }
        return redirect('/reg')->with('msg','注册失败');
    }

    public function send($name,$code){
      

// Download：https://github.com/aliyun/openapi-sdk-php
// Usage：https://github.com/aliyun/openapi-sdk-php/blob/master/README.md

AlibabaCloud::accessKeyClient('LTAI4Fh2MgKU9RMBeqVKtnA6', '3ft0Xj8PXi3QezcEU7i1gCUtg5aNXb')
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
                                          'PhoneNumbers' => "$name",
                                          'SignName' => "龙龙小草",
                                          'TemplateCode' => "SMS_182665157",
                                          'TemplateParam' => "{code:$name}",
                                        ],
                                    ])
                          ->request();
    return $result->toArray();
} catch (ClientException $e) {
    return $e->getErrorMessage() . PHP_EOL;
} catch (ServerException $e) {
    return $e->getErrorMessage() . PHP_EOL;
}

    }
    public function sendEmail(){
      $name = request()->name;
      //php验证
      $reg = '/^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/';
    //   dd(preg_match($reg, $name));
      if(!preg_match($reg, $name)){
        return json_encode(['code='>'00001','msg'=>'请输入正确的邮箱']);
      }
      //生成随机
      $code = rand(100000,999999);
        $res= Mail::to($name)->send(new SendCode($code));
        // echo "发送成功";
        // dd($res);exit;
        session(['code'=>$code]);
        return json_encode(['code='>'00000','msg'=>'发送成功']);

    }
    //  public function cartlist(){
    //   $cartInfo = Cart::all();
    //   $count = Cart::count();
    //   return view('index.cartlist',['cartInfo'=>$cartInfo,'count'=>$count]);
    // }

}
