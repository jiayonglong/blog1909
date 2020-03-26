<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Cookie;
class LoginController extends Controller
{
    public function login(){
        return view('login.login');
    }
    public function logindo(){
        $post = request()->except('_token');
        // dd($post);
        // $post['user_pwd'] = md5(md5($post['user_pwd']));
        $adminuser = User::where('name',$post['name'])->first(); 
        //如果解密后的密码和form表单传递的密码不一致返回登录页面并提示
        // dd($adminuser);
        if(decrypt($adminuser->user_pwd)!=$post['user_pwd']){
             return redirect('/login')->with('msg','用户或密码错误');
            }
            //七天登录
            if(isset($post['rember'])){
                Cookie::queue('adminuser',$adminuser,7*24*60);
            }
            session(['adminuser'=>$adminuser]);
            return redirect('/brand/index');
    }
}
