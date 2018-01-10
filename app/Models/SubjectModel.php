<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class SubjectModel extends Model
{
    protected $dates = ['deleted_at'];
    // 表名
    protected $table = 'subject';
    // 主键
    protected $primarykey = 'id';
    // 字段白名单
    protected $fillable = ['subject_name', 'logo', 'sort'];
}
