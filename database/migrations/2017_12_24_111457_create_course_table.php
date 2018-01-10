<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course', function (Blueprint $table) {
            $table->engine = 'myisam';
            $table->increments('id')->comment('主键ID');
            $table->unsignedInteger('profession_id')->comment('专业ID');
            $table->string('course_name',150)->comment('课程名称');  // varchar
            $table->decimal('price',9,2)->default('0.0')->comment('价格');
            $table->decimal('sale_price',9,2)->default('0.0')->comment('优惠价格');
            $table->unsignedInteger('teacher_id')->nullable()->comment('老师ID');
            $table->text('course_desc')->nullable()->comment('课程简介');
            $table->unsignedInteger('click')->default(0)->comment('点击量');
            $table->unsignedSmallInteger('duration')->default(0)->comment('课程总时长(单位：小时)');
            $table->unsignedInteger('sort')->default(0)->comment('排序');
            $table->unsignedInteger('expire_at')->default(0)->comment('有效时间');
            $table->unsignedInteger('number')->default(0)->comment('学习人数');
            $table->text('content')->nullable()->comment('专业详情');
            $table->string('cover',255)->nullable()->comment('封面图');
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
        Schema::dropIfExists('profession');
    }
}
