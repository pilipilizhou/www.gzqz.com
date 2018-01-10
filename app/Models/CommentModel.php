<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentModel extends Model
{
    protected $table = 'comment';
    // 告诉laravel当前表的主键是什么
    protected $primaryKey = 'id';
}
