<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeachersModel extends Model
{
    protected $table = "teachers";
    protected $primaryKey = "teacher_id";
    protected $fillable = ["username","cnname","phone","sex","remark","avatar","email"];
}
