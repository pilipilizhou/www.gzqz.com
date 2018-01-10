<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TeachersModel;

class TeacherController extends Controller
{
    // 显示老师列表
    public function Index(){
        return view('backend.teachers.index');
    }

    // 用于被datatables请求的ajax方法
    public  function ApiList(TeachersModel $teachersModel,Request $request){
        // 获取所有的老师数据,使用关联获取，with方法
        // with方法表示要关联哪一个属性with(模型里面的关联关系方法)
        $data = $teachersModel -> get();
        // 获取数据总数
        $count = $teachersModel -> count();
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

    // 显示添加老师界面
    public function  Add(){
        return view('backend.teachers.add');
    }

    // 添加老师入库的程序
    public function Store(Request $request) {
        // 获取所有的表单字段，数据库只会维护白名单
        $data = $request ->all();
        // 密码要加上bcrypt加密
        if(TeachersModel::create($data)) {
            return ['status'=>true,'message'=>'添加老师成功!'];
        }else{
            return ['status'=>false,'message'=>'添加老师失败!'];
        }
    }



    // 编辑模板
    public  function  Edit($teacher_id){
        // 通过主键找到老师的对应信息,返回老师对象
        $teacher = TeachersModel::find($teacher_id);
        return view('backend.teachers.edit')->with([
            'teacher_id' => $teacher_id, //把要修改的老师teacher_id传值到模板当中
            "teacher" => $teacher ,// 把老师赋值到模板中
        ]);
    }

    // 编辑老师入库
    public function  Save($teacher_id,Request $request) {
        // 通过主键找到老师的对应信息,返回老师对象
        $subject = TeachersModel::find($teacher_id);
        $data = $request ->all();
        // 在laravel5.4里面提供了一个修改白名单的方法updata
        // 修改白名单字段
        if($subject -> update($data)){
            return ['status'=>true,'message'=>"编辑老师成功！"];
        }else{
            return ['status'=>false,'message'=>"编辑老师失败！"];
        }
    }

    // 删除老师，使用teacher_id
    public function Remove($teacher_id) {
        // 找到要删除的老师，然后删除
        $teacher = TeachersModel::find($teacher_id);
        // 调用删除方法
        if($teacher -> delete()) {
            // 删除成功，返回json[status:true,message:'成功删除老师！']
            return ['status'=>true,"message"=>'成功删除老师！'];
        }else{
            return ['status'=>false,"message"=>'删除老师失败！'];
        }
    }

}
