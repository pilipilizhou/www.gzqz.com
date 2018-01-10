<?php

namespace App\Http\Middleware;

use App\Models\RoleModel;
use Closure;

class CheckPremission
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
        $role_id = Auth::guard('managerAuth')->user()->mg_role_ids;
        if ($role_id !=1){
            $role = RoleModel::find($role_id);
            $ac = explode(",",$role->role_permission_ac);
            $route = \Route::current();
            $route_uri = str_replace('/','-',$route->uri);
            if(!in_array($route_uri,$ac)){
                  exit('您没有操作的权限');
            }
        }
        return $next($request);
    }
}
