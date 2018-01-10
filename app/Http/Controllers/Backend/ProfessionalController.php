<?php

namespace App\Http\Controllers\Backend;

use App\Models\ProfessionalModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubjectModel;

class ProfessionalController extends Controller
{
    public function  Index() {
        return view("backend.professional.index");
    }



    // 用于被datatables请求的ajax方法
    public  function ApiList(ProfessionalModel $ProfessionalModel,Request $request){
        // 获取所有的专业数据,使用关联获取，with方法
        // with方法表示要关联哪一个属性with(模型里面的关联关系方法)
        $data = $ProfessionalModel ->with('Subject')-> get();
        // 获取数据总数
        $count = $ProfessionalModel -> count();
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

    // 显示添加模板，把专业信息显示到模板当中
    public function  Add() {
        //需要subject表的id和subject_name两个字段
        $subjects = SubjectModel::all(["id",'subject_name'])->toArray();
        return view("backend.professional.add")->with([
            'subjects'=>$subjects
        ]);
    }

    // 添加专业入库的程序
    public function Store(Request $request) {
        // 获取所有的表单字段，数据库只会维护白名单
        $data = $request ->all();
        // 密码要加上bcrypt加密
        if(ProfessionalModel::create($data)) {
            return ['status'=>true,'message'=>'添加专业成功!'];
        }else{
            return ['status'=>false,'message'=>'添加专业失败!'];
        }
    }


    // 编辑模板
    public  function  Edit($id){
        // 通过主键找到专业的对应信息,返回专业对象
        $profession = ProfessionalModel::find($id);
        //需要subject表的id和subject_name两个字段
        $subjects = SubjectModel::all(["id",'subject_name'])->toArray();
        return view('backend.professional.edit')->with([
            'id' => $id, //把要修改的专业id传值到模板当中
            "profession" => $profession ,// 把专业赋值到模板中
            'subjects'=>$subjects
        ]);
    }

    // 编辑专业入库
    public function  Save($id,Request $request) {
        // 通过主键找到专业的对应信息,返回专业对象
        $subject = ProfessionalModel::find($id);
        $data = $request ->all();
        // 在laravel5.4里面提供了一个修改白名单的方法updata
        // 修改白名单字段
        if($subject -> update($data)){
            return ['status'=>true,'message'=>"编辑专业成功！"];
        }else{
            return ['status'=>false,'message'=>"编辑专业失败！"];
        }
    }


    // 删除专业，使用id
    public function Remove($id) {
        // 找到要删除的专业，然后删除
        $profession = ProfessionalModel::find($id);
        // 调用删除方法
        if($profession -> delete()) {
            // 删除成功，返回json[status:true,message:'成功删除专业！']
            return ['status'=>true,"message"=>'成功删除专业！'];
        }else{
            return ['status'=>false,"message"=>'删除专业失败！'];
        }
    }

}
