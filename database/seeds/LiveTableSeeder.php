<?php

use Illuminate\Database\Seeder;
use App\Models\LiveModel;
class LiveTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run( LiveModel $LiveModel )
    {
        //清空表
        $LiveModel -> truncate();
        //插入数据
        $data=[
            'stream_id' => 6, //直播间
            'profession_id' => 1, //php 入门班
            'teacher_id' => 2, //老师名字为热巴
            'course_name' => 'pdo基础操作', //直播课程的名称
            'cover' => '201712281448033524.jpg', //封面
            'course_desc'=>'这是美女老师的公开课',
            'start_at' => '2017-12-29 10:00:00', //开始直播(推流)时间
            'end_at'   => '2017-12-29 13:00:00', //直播结束时间
        ];
        LiveModel::create( $data );
        $data=[
            'stream_id' => 6, //直播间
            'profession_id' => 1, //php 入门班
            'teacher_id' => 3, //老师名字为苏老师
            'course_name' => 'UI设计基础', //直播课程的名称
            'cover' => '201712281448033524.jpg', //封面
            'course_desc'=>'这是帅哥的公开课',
            'start_at' => '2017-12-29 10:00:00', //开始直播(推流)时间
            'end_at'   => '2017-12-29 13:00:00', //直播结束时间
        ];
        LiveModel::create( $data );

    }
}
