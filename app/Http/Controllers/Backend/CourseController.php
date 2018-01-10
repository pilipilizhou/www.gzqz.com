<?php

namespace App\Http\Controllers\Backend;

use App\Models\CourseModel;
use App\Models\ProfessionalModel;
use App\Models\RoleModel;
use App\Models\SubjectModel;
use App\Models\TeachersModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function  Index() {
        return view("backend.course.index");
    }

    //使用datatables插件显示课程列表
    public function ApiList( CourseModel $CourseModel,Request $Request ){
        $data = $CourseModel -> with('Profession')->with('Teachers') -> get();
        //获取数据的记录总数
        $count = $CourseModel -> count();
        //把datatables的json必选项组合成为数组
        $dataTables = [
            //是否需要刷新请求次数,一般在laravel中使用request->get(‘draw’)
            "draw"=>$Request->get('draw'),
            //要显示的记录数有多少条
            "recordsTotal" => $count,
            //要过滤的记录数有多少条
            "recordsFiltered" => $count,
            //要显示的数据源是什么
            "data" => $data
        ];
        //在laravel当中使用return返回是数组,那么在浏览器中直接展现为json格式的数据
        return $dataTables;
    }

    public function Add(){
        // 课程需要指定的授课老师
        $teachers = TeachersModel::all(['cnname','teacher_id']);
        $professions = ProfessionalModel::all(['id','profession_name']);
        //dd( $professions );
        return view('backend.course.add')-> with([
            'pros' => $professions,
            'teachers' => $teachers
        ]);
    }

    //添加入库的程序
    public function Store(Request $Request){
        //获取所有的表单字段，但是数据库只会维护白名单
        $data = $Request -> all();
        if( CourseModel::create( $data ) ){
            return ['status'=>true,'message'=>'添加课程成功!'];
        }else{
            return ['status'=>false,'message'=>'添加课程失败!'];
        }
    }

    // 编辑模板
    public  function  Edit($id){
        $professions = ProfessionalModel::all(['id','profession_name']);
        $teachers = TeachersModel::all(['cnname','teacher_id']);
        // 通过主键找到课程的对应信息,返回课程对象
        $course = CourseModel::find($id);
        return view('backend.course.edit')->with([
            'id' => $id, //把要修改的课程id传值到模板当中
            'course'=>$course,
            'pros' => $professions ,
            'teachers' =>  $teachers
        ]);
    }
    // 编辑课程入库
    public function  Save($id,Request $request) {
        // 通过主键找到课程的对应信息,返回课程对象
        $course = CourseModel::find($id);
        $data = $request ->all();
        // 在laravel5.4里面提供了一个修改白名单的方法updata
        // 修改白名单字段
        if($course -> update($data)){
            return ['status'=>true,'message'=>"编辑课程成功！"];
        }else{
            return ['status'=>false,'message'=>"编辑课程失败！"];
        }
    }


    // 删除课程，使用id
    public function Remove($id) {
        // 找到要删除的课程，然后删除
        $course = CourseModel::find($id);
        // 调用删除方法
        if($course -> delete()) {
            // 删除成功，返回json[status:true,message:'成功删除课程！']
            return ['status'=>true,"message"=>'成功删除课程！'];
        }else{
            return ['status'=>false,"message"=>'删除课程失败！'];
        }
    }

}
