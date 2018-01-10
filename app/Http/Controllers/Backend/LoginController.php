<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
#引入表单验证类
use Illuminate\Support\Facades\Validator;
#引入用户认证的命名空间
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function Index() {
        return view("backend.login");
    }
    //管理员登录的方法
    public function Login(Request $Request) {
        // 获取客户端提交表单信息
        $info = $Request -> only(['username','pwd','vcode']);

        /**验证规则
         * 1.用户名，密码，验证码必填
         * 2.密码长度6-16位
         */
        $rules = [
            'username' => 'required',#username 必填
            'pwd' => 'required|between:6,16' , #pwd 必填  ,密码长度6-16
            'vcode' => 'required|captcha' #验证码必填 验证码不区分大小写必须正确
        ];

        /**
         * 如果验证失败，那么就定义如下错误提示
         */
        $message = [
            #如果用户没有填写username字段，那么就提示
            "username.required" => '管理员帐号必须填写',
            "pwd.required" => "管理员密码必须填写",
            "pwd.between" => "管理员密码必须在6-16之间",
            "vcode.required" => "验证码必须填写",
            "vcode.captcha" => "验证码不正确"
        ];
        /**
         * 添加表单验证规则，使用Validator类
         * Validator::make方法用于产生验证规则，格式如下：
         * Validator::make(要验证的数据，验证的规则，验证错误的提示信息);
         */
        $Validator = Validator::make($info,$rules,$message);
        /**
         * 如果验证通不过，那么就Validator的fails()方法为true
         */
        if( $Validator -> fails() ) {
            // 把用户的提交信息一次性存储到session中
            $Request->flash();
            // 返回登录页面，带着错误验证信息一起返回
            return redirect() -> back() -> withErrors($Validator,'LoginErrors');
        }else{
            // 我们在用户认证中，要校验username是否正确，如果username正确，
            //我们还要校验用户密码的bcrypt加密是否正确，如果一切正确，我们需要把正确的用户信息放到session中，因此写以下代码
//            dump(Auth::guard('managerAuth')->attempt(['username'=>$info['username'],'password'=>$info['pwd']]));
            if(Auth::guard('managerAuth')->attempt(['username'=>$info['username'],'password'=>$info['pwd']])) {
                return redirect("System/Home/Index") ;
            }else{
                // 如果用户登录失败，告诉用户登录失败的信息
                #一次性获取用户所有输入资料
                $Request ->flash();
                return redirect() -> back() -> withErrors("管理帐号或者密码不正确",'LoginErrors');
            }

        }
    }
}

