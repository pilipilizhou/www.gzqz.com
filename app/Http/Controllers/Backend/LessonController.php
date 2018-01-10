<?php

namespace App\Http\Controllers\Backend;

use App\Models\CourseModel;
use App\Models\LessonModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LessonController extends Controller
{
    public function  Index() {
        return view("backend.Lesson.index");
    }



    // 用于被datatables请求的ajax方法
    public  function ApiList(LessonModel $LessonModel,Request $request){
        // 获取所有的课时数据,使用关联获取，with方法
        // with方法表示要关联哪一个属性with(模型里面的关联关系方法)
        $data = $LessonModel ->with("Course")-> get();
        // 获取数据总数
        $count = $LessonModel -> count();
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

    public function Add(){
        // 查出所属课程
        $courses = CourseModel::all(['id','course_name']);
        return view('backend.lesson.add')->with([
            'courses'=>$courses
        ]);

    }
    // 添加课时入库的程序
    public function Store(Request $request) {
        // 获取所有的表单字段，数据库只会维护白名单
        $data = $request ->all();
        // 密码要加上bcrypt加密
        if(LessonModel::create($data)) {
            return ['status'=>true,'message'=>'添加课时成功!'];
        }else{
            return ['status'=>false,'message'=>'添加课时失败!'];
        }
    }



    // 编辑模板
    public  function  Edit($id){
        // 通过主键找到课时的对应信息,返回课时对象
        $lesson = LessonModel::find($id);
        $courses = CourseModel::all(['id','course_name']);
        return view('backend.lesson.edit')->with([
            'id' => $id, //把要修改的课时id传值到模板当中
            "lesson" => $lesson ,// 把课时赋值到模板中
            'courses'=>$courses
        ]);
    }

    // 编辑课时入库
    public function  Save($id,Request $request) {
        // 通过主键找到课时的对应信息,返回课时对象
        $lesson = LessonModel::find($id);
        $data = $request ->all();
        // 在laravel5.4里面提供了一个修改白名单的方法updata
        // 修改白名单字段
        if($lesson -> update($data)){
            return ['status'=>true,'message'=>"编辑课时成功！"];
        }else{
            return ['status'=>false,'message'=>"编辑课时失败！"];
        }
    }


    // 删除课时，使用id
    public function Remove($id) {
        // 找到要删除的课时，然后删除
        $lesson = LessonModel::find($id);
        // 调用删除方法
        if($lesson -> delete()) {
            // 删除成功，返回json[status:true,message:'成功删除课时！']
            return ['status'=>true,"message"=>'成功删除课时！'];
        }else{
            return ['status'=>false,"message"=>'删除课时失败！'];
        }
    }

}
