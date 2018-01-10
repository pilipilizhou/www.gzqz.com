<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessionalModel extends Model
{
    // 表名
    protected $table = 'profession';
    // 主键
    protected $primarykey = 'id';
    // 字段白名单
    protected $fillable = ['subject_id', 'profession_name', 'price', 'sale_price', 'expire_at', 'number', 'content', 'cover', 'banner', 'profession_desc', 'click', 'duration', 'is_recommend', 'is_best', 'is_hot', 'sort'];

    // 专业: 学科
    // 多对一 (专业属于学科,belongsTo)
    public function  Subject(){
        // 关联的模型，主表的关联的id，关联的外键
        return $this->belongsTo('\App\Models\SubjectModel','subject_id','id') ;
    }

    // laravel5.4加一个叫做catst的属性，把数组转化为json的属性设置
    protected $casts = [
        'banner' => 'Array', // 高数laravel5.4，如果banner遇到了array就转化为json
        #'tmp' => 'Interger' // 告诉laravel5.4，如果tmp遇到12345的字符串转化为整数
    ];

    public function  Course(){
        return $this->hasMany('\App\Models\CourseModel','profession_id','id') ;
    }

}
