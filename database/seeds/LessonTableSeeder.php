<?php

use Illuminate\Database\Seeder;
use App\Models\LessonModel as Lesson;
class LessonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Lesson $lesson)
    {
        // 清空表数据
        $lesson->truncate();
        $lesson->create(['id'=>1,'course_id'=>1,'video_address'=>'/1.mp4','lesson_name'=>'WAMP介绍','duration'=>mt_rand(10, 60)]);
        $lesson->create(['id'=>2,'course_id'=>1,'video_address'=>'/1.mp4','lesson_name'=>'安装apache','duration'=>mt_rand(10, 60)]);
        $lesson->create(['id'=>3,'course_id'=>1,'video_address'=>'/1.mp4','lesson_name'=>'安装配置php和apache','duration'=>mt_rand(10, 60)]);

        $lesson->create(['id'=>4,'course_id'=>2,'video_address'=>'/1.mp4','lesson_name'=>'MySQL安装','duration'=>mt_rand(10, 60)]);
        $lesson->create(['id'=>5,'course_id'=>2,'video_address'=>'/1.mp4','lesson_name'=>'关系型数据库','duration'=>mt_rand(10, 60)]);
        $lesson->create(['id'=>6,'course_id'=>2,'video_address'=>'/1.mp4','lesson_name'=>'MySQL的CURD操作','duration'=>mt_rand(10, 60)]);

        $lesson->create(['id'=>7,'course_id'=>3,'video_address'=>'/1.mp4','lesson_name'=>'MVC模式简介','duration'=>mt_rand(10,60)]);
        $lesson->create(['id'=>8,'course_id'=>3,'video_address'=>'/1.mp4','lesson_name'=>'MVC流程实现','duration'=>mt_rand(10,60)]);
        $lesson->create(['id'=>9,'course_id'=>3,'video_address'=>'/1.mp4','lesson_name'=>'单入口模式','duration'=>mt_rand(10,60)]);
        $lesson->create(['id'=>10,'course_id'=>3,'video_address'=>'/1.mp4','lesson_name'=>'博客项目','duration'=>mt_rand(10,60)]);
    }
}
