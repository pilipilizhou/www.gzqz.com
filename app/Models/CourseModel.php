<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseModel extends Model
{
    // 表名
    protected $table = 'course';
    // 主键
    protected $primarykey = 'id';
    // 字段白名单
    protected $fillable = ['profession_id', 'course_name', 'price', 'sale_price', 'teacher_id', 'course_desc', 'click', 'duration', 'sort', 'expire_at', 'number', 'content', 'cover'];


    // 课程 ： 专业
    // 多对一 （课程属于专业）
    public function Profession(){
        return $this->belongsTo('App\Models\ProfessionalModel','profession_id','id');
    }

    // 课程 ： 老师
    // 多对一 （课程属于老师）
    public function Teachers(){
        return $this->belongsTo('App\Models\TeachersModel','teacher_id','teacher_id');
    }

    // 课程 : 课时
    // 一对多
    public  function  Lesson(){
        return $this->hasMany('App\Models\LessonModel','course_id','id');
    }
}
