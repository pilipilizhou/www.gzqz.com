<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class CheckMemberLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 进行登录判断
        // 如果没有登录，则使用redirect()->back() 进行拦截
        if( !Auth::guard('memberAuth')->check() ){
            // 记录当前用户要访问的地址
            Session::put('go_to',$request->getrequestUri());
            return redirect()->to('/Home/Members/Login')->withErrors('您尚未登录，请登录！');
        }

        return $next($request); // 跳转到当前uri地址指向的控制器中
    }
}
