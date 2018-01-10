<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StreamModel extends Model
{
    protected $table = 'stream';
    protected $primaryKey = 'id';
    protected $fillable = ['stream_name','status','expire_at'];

}
