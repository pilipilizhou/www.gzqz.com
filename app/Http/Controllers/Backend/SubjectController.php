<?php

namespace App\Http\Controllers\Backend;

use App\Models\SubjectModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubjectController extends Controller
{
    public function  Index() {
        return view("backend.subject.index");
    }


    // 用于被datatables请求的ajax方法
    public  function ApiList(SubjectModel $SubjectModel,Request $request){
        // 获取所有的学科数据,使用关联获取，with方法
        // with方法表示要关联哪一个属性with(模型里面的关联关系方法)
        $data = $SubjectModel -> get();
        // 获取数据总数
        $count = $SubjectModel -> count();
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


    // 添加入库界面
    public function  Add() {
        return view("backend.subject.add");
    }

    // 添加入库的程序
    public function Store(Request $request) {
        // 获取所有的表单字段，数据库只会维护白名单
        $data = $request ->all();
        // 密码要加上bcrypt加密
        if(SubjectModel::create($data)) {
            return ['status'=>true,'message'=>'添加学科成功!'];
        }else{
            return ['status'=>false,'message'=>'添加学科失败!'];
        }
    }

    // 编辑模板
    public  function  Edit($id){
        // 通过主键找到学科的对应信息,返回学科对象
        $subject = SubjectModel::find($id);
        return view('backend.subject.edit')->with([
            'id' => $id, //把要修改的学科id传值到模板当中
            "subject" => $subject // 把学科赋值到模板中
        ]);
    }



    // 编辑学科入库
    public function  Save($id,Request $request) {
        // 通过主键找到学科的对应信息,返回学科对象
        $subject = SubjectModel::find($id);
        $data = $request ->all();
        // 在laravel5.4里面提供了一个修改白名单的方法updata
        // 修改白名单字段
        if($subject -> update($data)){
            return ['status'=>true,'message'=>"编辑学科成功！"];
        }else{
            return ['status'=>false,'message'=>"编辑学科失败！"];
        }
    }


    // 删除学科，使用id
    public function Remove($id) {
        // 找到要删除的学科，然后删除
        $subject = SubjectModel::find($id);
        // 调用删除方法
        if($subject -> delete()) {
            // 删除成功，返回json[status:true,message:'成功删除学科！']
            return ['status'=>true,"message"=>'成功删除学科！'];
        }else{
            return ['status'=>false,"message"=>'删除学科失败！'];
        }
    }

}
