<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStreamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 创建 直播流表
        Schema::create('stream',function(Blueprint $table){
            $table->engine = "InnoDB";
            $table->increments('id')->comment('主键ID');
            $table->string('stream_name',150)->unique()->comment('流名称');
            $table->unsignedTinyInteger('status')->default(0)->comment('禁播状态(-1:永久禁播 0:关闭禁播(正常直播) 1:限时禁播)');
            $table->timestamp('expire_at')->nullable()->default(null)->comment('禁播时间失效时间');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stream');
    }
}
