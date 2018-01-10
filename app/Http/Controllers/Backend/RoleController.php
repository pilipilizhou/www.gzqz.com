<?php

namespace App\Http\Controllers\Backend;

use App\Models\RoleModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function  Index() {
        return view("backend.role.index");
    }

    // 用于被datatables请求的ajax方法
    public  function ApiList(RoleModel $roleModel,Request $request){
        // 获取所有的角色(老师)数据,使用关联获取，with方法
        // with方法表示要关联哪一个属性with(模型里面的关联关系方法)
        $data = $roleModel -> get();
        // 获取数据总数
        $count = $roleModel -> count();
        // 把datatables的json必选项组合成数组
        $dataTables =[
            // 是否需要刷新请求次数，一般在laravel中使用request->get('draw')
            "draw"=> $request ->get('draw'),
            // 要显示的记录数有多少条
            "recordsTotal"=>$count,
            //要过滤的记录数有多少条
            "recordsFiltered"=>$count,
            // 要显示的数据源是什么
            "data" => $data
        ];
        // 直接return一个数组，laravel会自动将数组转换为json模式
        return $dataTables;
    }


    // 添加角色(老师)界面
    public function  Add() {
        return view("backend.role.add");
    }

    // 添加入库的程序
    public function Store(Request $request) {
        // 获取所有的表单字段，数据库只会维护白名单
        $data = $request ->all();
        if(RoleModel::create($data)) {
            return ['status'=>true,'message'=>'添加角色(老师)成功!'];
        }else{
            return ['status'=>false,'message'=>'添加角色(老师)失败!'];
        }
    }

    // 删除角色(老师)，使用role_id
    public function Remove($role_id) {
        // 找到要删除的角色(老师)，然后删除
        $role = RoleModel::find($role_id);
        // 调用删除方法
        if($role -> delete()) {
            // 删除成功，返回json[status:true,message:'成功删除角色(老师)！']
            return ['status'=>true,"message"=>'成功删除角色(老师)！'];
        }else{
            return ['status'=>false,"message"=>'删除角色(老师)失败！'];
        }
    }


    // 编辑模板
    public  function  Edit($role_id){
        // 通过主键找到角色(老师)的对应信息,返回角色(老师)对象
        $role = RoleModel::find($role_id);
        return view('backend.role.edit')->with([
            'role_id' => $role_id, //把要修改的角色(老师)id传值到模板当中
            "role" => $role, // 把角色(老师)赋值到模板中
        ]);
    }

    // 编辑角色(老师)入库
    public function  Save($role_id,Request $request) {
        // 通过主键找到角色(老师)的对应信息,返回角色(老师)对象
        $role = RoleModel::find($role_id);
        // all() 提交的数据[mg_sex,mg_email,mg_remark,mg_phone]
        $data = $request ->all();
        // 在laravel5.4里面提供了一个修改白名单的方法updata
        // 修改白名单字段
        if($role -> update($data)){
            return ['status'=>true,'message'=>"编辑角色(老师)成功！"];
        }else{
            return ['status'=>false,'message'=>"编辑角色(老师)失败！"];
        }
    }

}
