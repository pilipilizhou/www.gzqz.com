<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PayRecodeModel extends Model
{
    use SoftDeletes; // 引入软删除的 trait
    protected $dates = ['deleted_at'];
    // 表名
    protected $table = 'pay_recode';
    // 主键
    protected $primarykey = 'id';
    // 字段白名单
    protected $fillable = ['profession_id', 'course_id', 'member_id', 'expire_start', 'expire_end'];

    // 专业与订单的关系
    //  1  :  多
    public function profession(){
        return $this->belongsTo(\App\Models\ProfessionalModel::class,'profession_id','id');
    }

    // 点播课程与订单的关系
    public function course(){
        return $this->belongsTo(\App\Models\CourseModel::class, 'course_id', 'id');
    }

    // 会员与订单关系
    public function member(){
        return $this->belongsTo(\App\Models\MembersModel::class, 'member_id', 'id');
    }
}
