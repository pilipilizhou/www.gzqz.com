<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemoModel extends Model
{
    protected $table = 'demo';
    // 告诉laravel当前表的主键是什么
    protected $primaryKey = 'id';
    // 关闭timestamps字段维护功能
    public $timestamps = false;
    // 声明字段的白名单
    public $fillable = ['name1','name2','name3','name4','name5','name6','name7','name8','name9'];
}
