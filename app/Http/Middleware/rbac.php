<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Route; // 导入路由类 
use App\Models\RoleModel;
class rbac
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
//        dump('我是中间件') ;
        //获取当前路由的信息
//        Route::current();
        $role_id = Auth::guard('managerAuth')->user()->mg_role_ids;
        if($role_id != 1){
            // 如果是非超级管理员，那么就需要做rbac验证
            $uri = \Route::current() -> uri;
            // 获取当前uri地址
            $uri = str_replace('/','-',$uri);
            // 获取当前的角色可以控制的路由有什么
            $RoleInfo = RoleModel::find($role_id,['role_permission_ac'])->toArray();
            $role_permission_ac = explode(',',$RoleInfo['role_permission_ac']);
            dump($role_permission_ac);
            dump("当前路由:".$uri);
            if(!in_array($uri,$role_permission_ac)){
                exit('您还没有该模块的操作权限');
                // return view();
            }
        }
        return $next($request); // 如果能够通过上面的逻辑直接转向下一个请求
    }
}
