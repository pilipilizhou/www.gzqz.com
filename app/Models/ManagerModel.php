<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// 引入命名空间，高数laravel当前orm模型准备做用户认证
use Illuminate\Foundation\Auth\User as Authenticatable;
// 把orm模型继承用户认证
class ManagerModel extends Authenticatable
{
    //如果配置了前缀，那么以下就会表示为qz_manager
    protected $table = "manager";
    // 主键
    protected $primaryKey = "mg_id";
    // 设置manager表的白名单,其余字段laravel自动维护
    protected $fillable = ['username','password','mg_role_ids','mg_sex','mg_phone','mg_email','mg_remark'];
    public function Role(){
        // 设置角色role_id跟福利院mg_role_ids1对1的关系
        return $this->hasOne('App\Models\RoleModel','role_id','mg_role_ids');
    }
}
