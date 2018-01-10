<?php

namespace App\Http\Controllers\Home;

use App\Models\LiveModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LiveController extends Controller
{
    public function Index(LiveModel $liveModel) {
        // 直播的时候需要显示课程名称，开始直播时间，结束直播的时间，课程的封面，主播老师的名字

        // 老师头像和课程简介
        $LiveInfo = $liveModel ->with('teacher')-> get();
        return view("home.live.index")->with([
            'LiveInfo' => $LiveInfo
        ]);
    }

    //根据用户点击过来的id推流   -- 拉流测试界面1
    public function Play($live_id,LiveModel $LiveModel){
        //根据直播课程id获取相关详细,只需要直播流就行了
        $liveInfo = LiveModel::where('id','=',$live_id)-> with('stream')->first();
        //生成直播的拉流地址
        $Hub = 'szphp7';//直播空间的名称
        $StreamKey = $liveInfo->stream->stream_name; //直播流(直播房间)的名称,itcast
        //组装拉流地址(观看地址)
        $pull = "rtmp://pili-publish.szphp7.moluo.net/{$Hub}/{$StreamKey}";
        return view('home.live.play')->with([
            'pull_address' => $pull,
            'liveInfo' => $liveInfo
        ]);
    }

     //直播视频界面 --拉流测试界面2
    public function detail($live_id){
        //根据直播课程id获取相关详细,只需要直播流就行了
        $liveInfo = LiveModel::where('id','=',$live_id)-> with('stream')->first();
        //生成直播的拉流地址
        $Hub = 'szphp7';//直播空间的名称
        $StreamKey = $liveInfo->stream->stream_name; //直播流(直播房间)的名称,itcast
        //组装拉流地址(观看地址)
        $pull = "rtmp://pili-publish.szphp7.moluo.net/{$Hub}/{$StreamKey}";
        return view('home.live.detail')->with([
            'pull' => $pull,
            'liveInfo' => $liveInfo
        ]);
    }
}
