<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagerTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void新建表
     */
    public function up()
    {
        //由于配置了表前缀：Schema::create()相当于编写了create table qz_manager
        //Blueprint 相当于字段生成器
        Schema::create("manager",function (Blueprint $table){
            // 如果我们要声明表的引擎为myisam
            $table -> engine = 'myisam';
            //`mg_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
            $table -> increments('mg_id')->comment("主键");
            //`username` varchar(64) NOT NULL COMMENT '名称',
            $table -> string('username',64)->comment("管理员名称");
            //`password` char(32) NOT NULL COMMENT '密码',
            $table -> char('password',64)->comment("管理员密码");
            //`mg_role_ids` varchar(200) DEFAULT NULL COMMENT '角色ids',
            $table -> string('mg_role_ids',200)->nullable()->comment("rbac角色");
            //`mg_sex` enum('男','女') NOT NULL DEFAULT '男' COMMENT '性别',
            $table -> enum('mg_sex',['男','女'])->default('男')->comment("性别");
            //`mg_phone` char(11) DEFAULT NULL COMMENT '手机号码',
            $table -> char('mg_phone',11)->nullable()->comment("手机号码");
            //`mg_email` varchar(64) DEFAULT NULL COMMENT '邮箱',
            $table -> string('mg_email',64)->nullable()->comment("邮箱");
            //`mg_remark` text NOT NULL COMMENT '备注',
            $table -> text('mg_remark')->comment("备注");
            //`created_at` timestamp NULL DEFAULT NULL COMMENT '添加时间',
            //`updated_at` timestamp NULL DEFAULT NULL COMMENT '修改时间',
            $table -> timestamps();
            //`deleted_at` timestamp NULL DEFAULT NULL COMMENT '删除时间',
            $table ->  softDeletes();
            //`remember_token` varchar(100) DEFAULT NULL COMMENT '记住我标记',
            $table -> rememberToken();
            // 建立唯一性索引 UNIQUE KEY `manager_username_unique` (`username`)
            $table -> unique('username');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void删除表
     */
    public function down()
    {
        // 删除manager表
        Schema::dropIfExists('manager');
    }
}
