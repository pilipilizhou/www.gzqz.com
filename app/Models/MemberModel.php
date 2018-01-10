<?php

namespace App\Models;
// 会员模型
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
class MemberModel extends Authenticatable
{
    use SoftDeletes; // 引入软删除的 trait
    protected $dates = ['deleted_at'];
    // 表名
    protected $table = 'member';
    // 主键
    protected $primarykey = 'id';
    // 字段白名单
    protected $fillable = ['type', 'username', 'avatar', 'nickname', 'sex', 'password', 'email', 'phone', 'sort', 'job', 'login_rec', 'login_ip', 'disabled_at'];
}
