<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    protected $table = 'role';
    protected $primaryKey ="role_id";
    //角色白名单
    protected  $fillable = ['role_name','role_auth_ids','role_auth_ac'];

}
