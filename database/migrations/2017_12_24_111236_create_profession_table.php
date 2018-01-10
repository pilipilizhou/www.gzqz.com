<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profession', function (Blueprint $table) {
            $table->engine = 'myisam';
            $table->increments('id')->comment('主键ID');
            $table->unsignedSmallInteger('subject_id')->comment('学科ID');
            $table->string('profession_name',150)->unique()->comment('专业名称');  // varchar
            $table->decimal('price',9,2)->default('0.0')->comment('价格');
            $table->decimal('sale_price',9,2)->default('0.0')->comment('优惠价格');
            $table->unsignedInteger('expire_at')->default(0)->comment('有效时间');
            $table->unsignedInteger('number')->default(0)->comment('学习人数');
            $table->text('teacher_ids')->nullable()->comment('专业老师的ids串');
            $table->text('content')->nullable()->comment('专业详情');
            $table->string('cover',255)->nullable()->comment('封面图');
            $table->text('banner')->nullable()->comment('轮播图');
            $table->text('profession_desc')->nullable()->comment('专业简介');
            $table->unsignedInteger('click')->default(0)->comment('点击量');
            $table->unsignedSmallInteger('duration')->default(0)->comment('专业总时长(单位：小时)');
            $table->unsignedTinyInteger('is_recommend')->default(0)->comment('是否推荐专业');
            $table->unsignedTinyInteger('is_best')->default(0)->comment('是否优秀专业');
            $table->unsignedTinyInteger('is_hot')->default(0)->comment('是否热门专业');
            $table->unsignedInteger('sort')->default(0)->comment('排序');
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
