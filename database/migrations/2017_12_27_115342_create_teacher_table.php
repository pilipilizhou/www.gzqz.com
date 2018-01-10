<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //create table qz_role
        Schema::create("teachers",function(Blueprint $table){
            $table -> engine='myisam';
            //member_id int unsigned primary key auto_increment,
            $table -> increments('teacher_id')->comment('主键Id');
            $table -> string('avatar',60) -> comment('老师的头像');
            //username varchar(60) not null,
            $table -> string('username',60) -> comment('老师账号');
            //cnname varchar(20) default null,
            $table -> string('cnname',20) -> nullable() -> comment('中文名');
            //phone varchar(11) default null,
            $table -> string('phone',11) ->  nullable() -> comment('手机号码');
            //sex enum('男','女','保密') NOT NULL DEFAULT '男' COMMENT '性别',
            $table->enum('sex', ['男', '女'])->default('男') ->comment('性别');
            $table -> string('email',255) ->  nullable() -> comment('email');
            //remark text default null COMMENT '简介',
            $table -> text('remark') ->  nullable() -> comment('简介,备注信息');
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}
