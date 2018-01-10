<?php

namespace App\Http\Controllers\Home;

use App\Models\LessonModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlayVideoController extends Controller
{
    public function index($lesson_id,LessonModel $lessonModel){
        $lesson = $lessonModel->where("id",$lesson_id)->first();
        return view('home.playvideo.detail')->with([
            'lesson' => $lesson
        ]);
    }
}
