<?php

namespace App\Http\Controllers\Backend;

use App\Models\PermissionModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{

    public function  Index(){
        return view('backend.permission.index');
    }

    // 用于被datatables请求的ajax方法
    public  function ApiList(PermissionModel $permissionModel,Request $request){
        // 获取所有的权限数据,使用关联获取，with方法
        // with方法表示要关联哪一个属性with(模型里面的关联关系方法)
        $data = $permissionModel -> get();
        // 获取数据总数
        $count = $permissionModel -> count();
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


    // 显示添加模板，把权限信息显示到模板当中
    public function  Add() {
        //需要subject表的id和subject_name两个字段
        return view("backend.permission.add");
    }


    // 添加权限入库的程序
    public function Store(Request $request) {
        // 获取所有的表单字段，数据库只会维护白名单
        $data = $request ->all();
        // 密码要加上bcrypt加密
        if(PermissionModel::create($data)) {
            return ['status'=>true,'message'=>'添加权限成功!'];
        }else{
            return ['status'=>false,'message'=>'添加权限失败!'];
        }
    }


    // 编辑模板
    public  function  Edit($ps_id){
        // 通过主键找到权限的对应信息,返回权限对象
        $permission = PermissionModel::find($ps_id);
        return view('backend.permission.edit')->with([
            'ps_id' =>$ps_id, //把要修改的权限id传值到模板当中
            "permission" => $permission ,// 把权限赋值到模板中
        ]);
    }

    // 编辑权限入库
    public function  Save($ps_id,Request $request) {
        // 通过主键找到权限的对应信息,返回权限对象
        $subject = PermissionModel::find($ps_id);
        $data = $request ->all();
        // 在laravel5.4里面提供了一个修改白名单的方法updata
        // 修改白名单字段
        if($subject -> update($data)){
            return ['status'=>true,'message'=>"编辑权限成功！"];
        }else{
            return ['status'=>false,'message'=>"编辑权限失败！"];
        }
    }


    // 删除权限，使用ps_id
    public function Remove($ps_id) {
        // 找到要删除的权限，然后删除
        $permission = PermissionModel::find($ps_id);
        // 调用删除方法
        if($permission -> delete()) {
            // 删除成功，返回json[status:true,message:'成功删除权限！']
            return ['status'=>true,"message"=>'成功删除权限！'];
        }else{
            return ['status'=>false,"message"=>'删除权限失败！'];
        }
    }




}
