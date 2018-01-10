<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 创建数据表
        Schema::create('subject', function (Blueprint $table) {
            $table->engine = 'myisam'; // 表类型
            // `id` smallint unsigned not null auto_increment comment '主键ID',
            // primary key (`id`),
            $table->smallIncrements('id')->comment('主键ID');
            // `subject_name` varchar(50) not null comment '学科名称',
            // unique key (`subject_name`)
            $table->string('subject_name', 50)->unique()->comment('学科名称');
            // `logo` varchar(255) null default null comment 'logo',            
            $table->string('logo',255)->nullable()->comment('logo');
            // `sort` smallint  default 0 comment '排序',
            $table->smallInteger('sort')->default(0)->comment('排序');
            // `created_at` timestamp null default null,
            // `updated_at` timestamp null default null,
            $table->timestamps(); // 这里会自动生成created_at 和 updated_at 两个字段
            $table->softDeletes()->comment('删除时间'); // 软删除字段
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // 删除数据表
        Schema::dropIfExists('subject');
    }
}
