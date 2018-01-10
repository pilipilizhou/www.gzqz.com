<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
         * create table members
(
  member_id int unsigned primary key auto_increment,
  username varchar(60) not null,
  password varchar(64) not null,
  cnname varchar(20) default null,
  phone varchar(11) default null,
  sex enum('男','女','保密') NOT NULL DEFAULT '男' COMMENT '性别',
  remark text default null COMMENT '简介',
  address varchar(255) default null COMMENT '联系地址',
  created_at timestamp,
  updated_at timestamp
)charset=utf8 engine=myisam;
         */

        Schema::create("members",function (Blueprint $table){
            // 如果我们要声明表的引擎为myisam
            $table -> engine = 'myisam';
            $table -> increments('member_id')->comment("主键");
            $table -> string('username',60)->comment("会员名称");
            $table -> string('password',64)->comment("会员密码");
            $table -> string('cnname',20)->comment("会员昵称");
            $table -> string('phone',11)->comment("会员电话");
            $table -> enum('sex',['男','女','保密'])->default('男')->comment("性别");
            $table -> text('remark')->nullable()->comment("简介");
            $table -> string('address',255)->nullable()->comment("联系地址");
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
        Schema::dropIfExists('members');
    }
}
