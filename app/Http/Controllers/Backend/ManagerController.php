<?php

namespace App\Http\Controllers\Backend;

use App\Models\ManagerModel;
use App\Models\RoleModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManagerController extends Controller
{
    public function  Index() {
        return view("backend.manager.index");
    }

    // 用于被datatables请求的ajax方法
    public  function ApiList(ManagerModel $managerModel,Request $request){
        // 获取所有的管理员数据,使用关联获取，with方法
        // with方法表示要关联哪一个属性with(模型里面的关联关系方法)
        $data = $managerModel ->with('Role')-> get();
        // 获取数据总数
        $count = $managerModel -> count();
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

    // 删除管理员，使用mg_id
    public function Remove($mg_id) {
        // 找到要删除的管理员，然后删除
        $manager = ManagerModel::find($mg_id);
        // 调用删除方法
        if($manager -> delete()) {
            // 删除成功，返回json[status:true,message:'成功删除管理员！']
            return ['status'=>true,"message"=>'成功删除管理员！'];
        }else{
            return ['status'=>false,"message"=>'删除管理员失败！'];
        }
    }

    // 添加管理员界面
    public function  Add() {
        $roles = RoleModel::all(['role_id','role_name'])->toArray();
        return view("backend.manager.add")->with([
            "roles" => $roles
        ]);
    }

    // 添加入库的程序
    public function Store(Request $request) {
        // 获取所有的表单字段，数据库只会维护白名单
        $data = $request ->all();
        // 密码要加上bcrypt加密

        $data['password'] = bcrypt($data['password']);
        if(ManagerModel::create($data)) {
            return ['status'=>true,'message'=>'添加管理员成功!'];
        }else{
            return ['status'=>false,'message'=>'添加管理员失败!'];
        }
    }



    // 编辑模板
    public  function  Edit($mg_id){
        // 通过主键找到管理员的对应信息,返回管理员对象
        $manager = ManagerModel::find($mg_id);
        $roles = RoleModel::all(['role_id','role_name'])->toArray();
        return view('backend.manager.edit')->with([
            'mg_id' => $mg_id, //把要修改的管理员id传值到模板当中
            "manager" => $manager, // 把管理员赋值到模板中
            "roles" => $roles
        ]);
    }

    // 编辑管理员入库
    public function  Save($mg_id,Request $request) {
        // 通过主键找到管理员的对应信息,返回管理员对象
        $manager = ManagerModel::find($mg_id);
        // all() 提交的数据[mg_sex,mg_email,mg_remark,mg_phone]
        $data = $request ->all();
        // 在laravel5.4里面提供了一个修改白名单的方法updata
        // 修改白名单字段
        if($manager -> update($data)){
            return ['status'=>true,'message'=>"编辑管理员成功！"];
        }else{
            return ['status'=>false,'message'=>"编辑管理员失败！"];
        }
    }




















































































}
