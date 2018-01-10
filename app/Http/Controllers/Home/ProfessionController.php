<?php

namespace App\Http\Controllers\home;

use App\Models\CourseModel;
use App\Models\ProfessionalModel;
use App\Models\TeachersModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfessionController extends Controller
{
    public function  Detail($profession_id,ProfessionalModel $professionalModel,TeachersModel $teachersModel){
         $professionInfo  = $professionalModel->where('id',$profession_id)->with(['Course'=>function($query){
             return $query->with('Lesson');
         }])->first();
         $teacher_list = $teachersModel->select('cnname')->whereIn('teacher_id',explode(',',$professionInfo->teacher_ids))->get()->toArray();
         $teachers = [];
         foreach ($teacher_list as $teacher){
                 $teachers[] = $teacher['cnname'];
         }
        $professionInfo->teacher_ids = implode(',',$teachers);

        // 课程

//        return $professionInfo;
         return view('home.profession.detail')->with([
             'professionInfo'=>$professionInfo
         ]);
    }


    /**获取专业内容
     * @param $profession_id
     */
    public function professionContent($profession_id,ProfessionalModel $professionalModel){
         $content =  $professionalModel->where('id',$profession_id)->first(['content']);
         if(isset($content->content)){
             return ["status"=>true,'professionContent'=>$content->content];
         }else{
             return ["status"=>false,'professionContent'=>"暂无该专业课程的介绍..."];
         }


    }


    /**获取专业教师详情
     * @param $profession_id
     */
    public function professionTeachers($profession_id,TeachersModel $teachersModel,ProfessionalModel $professionalModel){
        $professionTeachers  = $professionalModel->where('id',$profession_id)->first(['teacher_ids']);
        $teacher_list = $teachersModel->select(['avatar','cnname','remark'])->whereIn('teacher_id',explode(',',$professionTeachers->teacher_ids))->get();
        return ["status"=>true,'professionTeachers'=>$teacher_list];


    }
}
