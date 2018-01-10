<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonModel extends Model
{
    // 表名
    protected $table = 'lesson';
    // 主键
    protected $primarykey = 'id';
    // 字段白名单
    protected $fillable = ['course_id', 'lesson_name', 'cover', 'video_address', 'lesson_desc', 'duration', 'sort'];
    public  function Course(){
        return $this->belongsTo("\App\Models\CourseModel","course_id","id");
    }
}
