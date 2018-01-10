<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticateable;
class MembersModel extends Authenticateable
{
    protected  $table = "members";
    protected  $primaryKey ="member_id";
    protected  $fillable = ['username','password','cnname','phone','sex','remark','address'];
}
