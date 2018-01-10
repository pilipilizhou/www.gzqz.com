<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 创建  会员购买课程/专业的记录表
        Schema::create('pay_recode', function (Blueprint $table) {
            $table->engine = 'innodb';
            $table->increments('id')->comment('主键ID');
            $table->unsignedInteger('profession_id')->nullable()->comment('专业ID');
            $table->unsignedInteger('course_id')->nullable()->comment('课程ID');
            $table->unsignedInteger('member_id')->comment('会员ID');
            $table->timestamp('expire_start')->nullable()->default(null)->comment('有效时间[开始]');
            $table->timestamp('expire_end')->nullable()->default(null)->comment('有效时间[结束]');
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
        Schema::dropIfExists('pay_recode');
    }
}
