<?php

namespace App\Http\Controllers\Backend;

use App\Models\ManagerModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionModel;
class HomeController extends Controller
{
    // 系统首页
    public function  Index() {
        // 获取管理员的用户名，谁知道登录操作系统
        $mgUser = Auth::guard('managerAuth')->user()->username;
        // 获取管理员的id，谁知道登录操作系统
        $mgId= Auth::guard('managerAuth')->user()->mg_id;

        if($mgUser != 'root'){
            // 如果用户不是超级管理员，那么我们就需要知道他们的角色
            $mgRoleInfo = ManagerModel::where('mg_id',$mgId)->with('Role')->first();
            // 获取该角色可以控制的模块
            $role_permission_ids = explode(',',$mgRoleInfo -> role -> role_permission_ids);
            // 根据获取到模板id在qz_permission表中获取对应的模块信息为0的级别
            $permissions_level_0 = PermissionModel::whereIn('ps_id',$role_permission_ids)->where('ps_level','0') ->get();
            // 根据获取到模板id在qz_permission表中获取对应的模块信息为1的级别
            $permissions_level_1 = PermissionModel::whereIn('ps_id',$role_permission_ids)->where('ps_level','1') ->get();
            $RoleName = $mgRoleInfo->role->role_name;
        }else{

            // 如果是超级管理员登录，那么就实现所有的菜单
            // 根据获取到模板id在qz_permission表中获取对应的模块信息为0的级别
            $permissions_level_0 = PermissionModel::where('ps_level',"=",'0') ->get();
            // 根据获取到模板id在qz_permission表中获取对应的模块信息为1的级别
            $permissions_level_1 = PermissionModel::where('ps_level','=','1') ->get();
            $RoleName = "超级管理员";
        }
        // 把模版执行views/backend/home/index.blade.php文件中
        return view('backend.home.index')->with([
            'permissions_level_0' => $permissions_level_0,
            'permissions_level_1' => $permissions_level_1,
            'RoleName' => $RoleName
        ]);
    }

    // 系统欢迎页
    public function  Welcome() {
        // 把模版执行views/backend/home/Welcome.blade.php文件中
        return view('backend.home.Welcome');
    }

    // 退出系统登录页
    public function Logout(){
        // 用户认证的退出登录方法
        Auth::guard('managerAuth')->logout();
        return ['status'=>true,"message"=>'退出成功！'];
    }
}
