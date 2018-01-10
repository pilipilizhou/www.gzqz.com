<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiveModel extends Model
{
    // 表名
    protected $table = 'live';
    // 主键
    protected $primarykey = 'id';
    // 字段白名单
    protected $fillable = ['profession_id', 'stream_id', 'course_name', 'cover', 'teacher_id', 'course_desc', 'sort', 'start_at', 'end_at'];

    //直播课程和专业的关系
    //   多   :  1
    public function profession(){
        return $this -> belongsTo('App\Models\ProfessionalModel','profession_id','id');
    }
    //直播课程和直播流的关系
    // 多     :   1
    public function stream(){
        return $this -> belongsTo('App\Models\StreamModel','stream_id','id');
    }

    //直播课程和老师的关系
    // 多     :   1
    public function teacher(){
        return $this -> belongsTo('App\Models\TeachersModel','teacher_id','teacher_id');
    }
}
