<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        /*
         *
         * ` role_id` int(10) unsigned NOT NULL COMMENT '主键',
              //`role_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '角色名称',
              //`role_auth_ids` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '权限ids,1,2,5',
              //`role_auth_ac` text COLLATE utf8mb4_unicode_ci COMMENT '控制器-操作,控制器-操作,控制器-操作',
              //`created_at` timestamp NULL DEFAULT NULL,
              //`updated_at` timestamp NULL DEFAULT NULL,
              //`deleted_at` timestamp NULL DEFAULT NULL
         * */
        Schema::create("role",function (Blueprint $table){
            // 如果我们要声明表的引擎为myisam
            $table -> engine = 'myisam';
            //`role_id` int(10) unsigned NOT NULL COMMENT '主键',
            $table -> increments('role_id')->comment("主键");
            //`role_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '角色名称',
            $table -> string('role_name',60)->comment("角色名称");
            //`role_auth_ids` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '权限ids,1,2,5',
            $table -> string('role_auth_ids',128)->nullable()->comment("权限ids,1,2,5");
            //`role_auth_ac` text COLLATE utf8mb4_unicode_ci COMMENT '控制器-操作,控制器-操作,控制器-操作',
            $table -> text('role_auth_ac')->nullable()->comment("控制器-操作,控制器-操作,控制器-操作");
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
        // 删除manager表
        Schema::dropIfExists('role');
    }
}
