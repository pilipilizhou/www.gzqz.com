<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 创建  点播课程表
        Schema::create('live', function (Blueprint $table) {
            $table->engine = 'innodb';
            $table->increments('id')->comment('主键ID');
            $table->unsignedInteger('profession_id')->comment('专业ID');
            $table->unsignedInteger('stream_id')->comment('直播流ID');
            $table->string('course_name',150)->comment('课程名称');  // varchar
            $table->string('cover',255)->nullable()->comment('封面图');            
            $table->unsignedInteger('teacher_id')->nullable()->comment('老师ID');
            $table->text('course_desc')->nullable()->comment('课程简介');
            $table->unsignedInteger('sort')->default(0)->comment('排序');
            $table->timestamp('start_at')->nullable()->default(null)->comment('开始时间');
            $table->timestamp('end_at')->nullable()->default(null)->comment('结束时间');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('live');
    }
}
