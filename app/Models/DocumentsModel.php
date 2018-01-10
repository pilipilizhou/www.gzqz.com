<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentsModel extends Model
{
    // 把该orm模型对应到mysql的documents表中
    protected $table = 'documents';
    // 告诉laravel当前表的主键是什么
    protected $primaryKey = 'id';
    // 关闭timestamps字段维护功能
    public $timestamps = false;
}
