<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdertAble extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 创建  订单表
        Schema::create('order', function (Blueprint $table) {
            $table->engine = 'innodb';
            $table->increments('id')->comment('主键ID');
            $table->string('order_number',150)->unique()->comment('订单号');
            $table->unsignedInteger('status')->comment('订单状态');
            $table->timestamp('pay_at')->nullable()->default(null)->comment('支付时间');
            $table->unsignedInteger('profession_id')->nullable()->comment('专业ID');
            $table->unsignedInteger('course_id')->nullable()->comment('课程ID');
            $table->unsignedInteger('member_id')->comment('会员ID');
            $table->string('order_name',150)->comment('订单名称');
            $table->string('note',255)->nullable()->comment('备注');
            $table->decimal('price',9,2)->default('0.0')->comment('订单价格');
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
        Schema::dropIfExists('order');
    }
}
