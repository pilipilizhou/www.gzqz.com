<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionModel extends Model
{
    protected  $table = 'permission';
    protected  $primaryKey = 'ps_id';
    protected  $fillable = ['ps_id','ps_name','ps_pid','ps_c','ps_a','address','ps_level'];
}
