<?php

namespace App\Http\Controllers\Backend;

use App\Models\ProfessionalModel;
use App\Models\StreamModel;
use App\Models\TeachersModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LiveModel;
class LiveController extends Controller
{
    public function Index(LiveModel $LiveModel){
        return view('backend.live.index');
    }

    //用于被datatables请求的ajax方法
    public function ApiList( LiveModel $LiveModel,Request $Request ){
        $data = $LiveModel -> with('profession','stream','teacher')->get();

        $count = $LiveModel -> count();
        //把datatables的json必选项组合成为数组
        $dataTables = [
            //是否需要刷新请求次数,一般在laravel中使用request->get(‘draw’)
            "draw"=>$Request->get('draw'),
            //要显示的记录数有多少条
            "recordsTotal" => $count,
            //要过滤的记录数有多少条
            "recordsFiltered" => $count,
            //要显示的数据源是什么
            "data" => $data
        ];

        //在laravel当中使用return返回是数组,那么在浏览器中直接展现为json格式的数据
        return $dataTables;
    }
    //显示当前的直播详细信息
    public function LiveInfo($live_id,LiveModel $LiveModel){
        //根据直播课程id获取相关详细
        $liveInfo = LiveModel::where('id','=',$live_id)-> with('profession','stream','teacher')->first();
        //生成直播鉴权的有效时间
        if( strtotime( $liveInfo -> start_at ) >= time() ){
            //如果开始时间大于当前时间,表示直播没有开始
            $expireAt = strtotime( $liveInfo -> start_at ) + 3600;
        }else if( strtotime( $liveInfo -> end_at ) < time() ){
            //如果直播的结束时间小于当前的时间,表示直播已经结束了
            $expireAt = strtotime( $liveInfo -> end_at ) + 3600;
        }else{
            $expireAt = time() + 3600; //如果主播迟到了,那么就从当前时间开始直播
        }
        //生成直播的推流token
        $Hub = 'szphp7';//直播空间的名称
        $StreamKey = $liveInfo->stream->stream_name; //直播流(直播房间)的名称,itcst
        $path = "/{$Hub}/{$StreamKey}?e={$expireAt}";
        //获取你的ak
        $ak = 'UhYWJIgbXnIzPHiZdVCenSnWVksXLlOY4WBAYc91';
        //获取你的sk
        $sk = 'kVIfTnGjvMU6U9f7l5n_0cTzG4rlGh_v-MXdcKlf';
        $qiniu = new \Qiniu\Auth($ak,$sk); //使用curl去验证的
        $token = $qiniu->sign($path);  //生成token
        //组装的推流地址
        $push = "rtmp://pili-publish.szphp7.moluo.net/{$Hub}/{$StreamKey}?e={$expireAt}&token={$token}";
        //组装拉流地址(观看地址)
        $pull = "rtmp://pili-publish.szphp7.moluo.net/{$Hub}/{$StreamKey}";

        return view('backend.live.show')->with([
            'liveInfo' => $liveInfo,
            'push_address' => $push,
            'pull_address' => $pull,
        ]);
    }


    public function SendMail($live_id,LiveModel $LiveModel){
        //根据直播课程id获取相关详细
        $liveInfo = LiveModel::where('id','=',$live_id)-> with('profession','stream','teacher')->first();
        //生成直播鉴权的有效时间
        if( strtotime( $liveInfo -> start_at ) >= time() ){
            //如果开始时间大于当前时间,表示直播没有开始
            $expireAt = strtotime( $liveInfo -> start_at ) + 3600;
        }else if( strtotime( $liveInfo -> end_at ) < time() ){
            //如果直播的结束时间小于当前的时间,表示直播已经结束了
            $expireAt = strtotime( $liveInfo -> end_at ) + 3600;
        }else{
            $expireAt = time() + 3600; //如果主播迟到了,那么就从当前时间开始直播
        }
        //生成直播的推流token
        $Hub = 'szphp7';//直播空间的名称
        $StreamKey = $liveInfo->stream->stream_name; //直播流(直播房间)的名称,itcst
        $path = "/{$Hub}/{$StreamKey}?e={$expireAt}";
        //获取你的ak
        $ak = 'UhYWJIgbXnIzPHiZdVCenSnWVksXLlOY4WBAYc91';
        //获取你的sk
        $sk = 'kVIfTnGjvMU6U9f7l5n_0cTzG4rlGh_v-MXdcKlf';
        $qiniu = new \Qiniu\Auth($ak,$sk); //使用curl去验证的
        $token = $qiniu->sign($path);  //生成token
        //组装的推流地址
        $push = "rtmp://pili-publish.szphp7.moluo.net/{$Hub}/{$StreamKey}?e={$expireAt}&token={$token}";
        //组装拉流地址(观看地址)
        $pull = "rtmp://pili-publish.szphp7.moluo.net/{$Hub}/{$StreamKey}";
        //send发送的时候使用post+socket形式请求
        //send有三个参数
        //参数1:视图的模板地址
        //参数2:是视图中赋值数据
        //参数3:email发送的回调方法,实例化mail类
        $data = [
            'teacher' => $liveInfo->teacher->cnname,
            'course_name' => $liveInfo->course_name,
            'start_at' => $liveInfo->start_at,
            'end_at' => $liveInfo->end_at,
            'push' => $push,
            'pull' => $pull,
        ];
        //获取老师的email地址
        $address = $liveInfo->teacher->email;
        //定义邮件标题
        $title = "<<".$liveInfo->course_name.">>直播课程通知";
        //由于Mail类的第3个参数一个闭包的函数,所以无法看到外面的变量作用域,因此我们需要使用use方法
        \Mail::send('mails.teacher',$data,function($mail) use($address,$title){
            $mail -> to($address); //发送给谁
            $mail -> subject($title);
        });
        //因为Mail类没有返回值,所以直接return true
        return ['status'=>true,'message'=>"发送邮件成功!"];

    }

    //发送手机短信
    public function SendSms($live_id,LiveModel $LiveModel){
        //根据直播课程id获取相关详细
        $liveInfo = LiveModel::where('id','=',$live_id)-> with('profession','teacher')->first();

        //定义短信模板
        $tpl = [
            'Aliyun' => 'SMS_120366375'
        ];
//        $data = [
//            'teacher' => $liveInfo->teacher->cnname,
//            'time'=>date('H:i',strtotime( $liveInfo->start_at ) ),
//        ];
        $data = [
            'name' => $liveInfo->teacher->cnname,
            'time' =>date('H:i',strtotime( $liveInfo->start_at ) )
        ];
        //to方法:表示要发给哪个手机号码
        //template方法:表示使用哪个一个前面模板
        //data:对短信模板的变量进行赋值操作
        //send:发送短信
        $phone = $liveInfo->teacher->phone;
        $res = \PhpSms::make() -> to($phone) -> template($tpl) -> data($data) -> send();

        if( $res['success'] ){
            return ['status'=>true,'message'=>'发送短信成功'];
        }else{
            return ['status'=>false,'message'=>'发送短信失败'];
        }
    }



    // 显示添加模板，把直播课程信息显示到模板当中
    public function  Add() {
        $professionList  = ProfessionalModel::all(['id','profession_name']);
        $teacherList  = TeachersModel::all(['teacher_id','cnname']);
        $streamList  = StreamModel::all(['id','stream_name']);

        return view("backend.live.add")->with([
            'professionList'=>$professionList,
            'teacherList' => $teacherList,
            'streamList' => $streamList
        ]);
    }

    // 添加直播课程入库的程序
    public function Store(Request $request) {
        // 获取所有的表单字段，数据库只会维护白名单
        $data = $request ->all();
        $data['start_at'] = date("Y-m-d H:i:s",strtotime($data['start_at']));
        $data['end_at'] = date("Y-m-d H:i:s",strtotime($data['end_at']));
        // 密码要加上bcrypt加密
        if(LiveModel::create($data)) {
            return ['status'=>true,'message'=>'添加直播课程成功!'];
        }else{
            return ['status'=>false,'message'=>'添加直播课程失败!'];
        }
    }


    // 删除直播课程，使用id
    public function Remove($id) {
        // 找到要删除的直播课程，然后删除
        $liveModel = LiveModel::find($id);
        // 调用删除方法
        if($liveModel -> delete()) {
            // 删除成功，返回json[status:true,message:'成功删除直播课程！']
            return ['status'=>true,"message"=>'成功删除直播课程！'];
        }else{
            return ['status'=>false,"message"=>'删除直播课程失败！'];
        }
    }


    // 编辑模板
    public  function  Edit($id){
        // 通过主键找到直播课程的对应信息,返回直播课程对象
        $liveModel= LiveModel::find($id);
        $professionList  = ProfessionalModel::all(['id','profession_name']);
        $teacherList  = TeachersModel::all(['teacher_id','cnname']);
        $streamList  = StreamModel::all(['id','stream_name']);

        $liveModel['start_at'] = date("yyyy-MM-ddTHH:mm",strtotime($liveModel['start_at']));
        $liveModel['end_at'] = date("yyyy-MM-ddTHH:mm",strtotime($liveModel['end_at']));
        return view('backend.live.edit')->with([
            'id' => $id, //把要修改的直播课程id传值到模板当中
            "live" => $liveModel,// 把直播课程赋值到模板中
            'professionList'=>$professionList,
            'teacherList' => $teacherList,
            'streamList' => $streamList
        ]);
    }

    // 编辑直播课程入库
    public function  Save($id,Request $request) {
        // 通过主键找到直播课程的对应信息,返回直播课程对象
        $liveModel = LiveModel::find($id);
        $data = $request ->all();
        // 在laravel5.4里面提供了一个修改白名单的方法updata
        // 修改白名单字段
        if($liveModel -> update($data)){
            return ['status'=>true,'message'=>"编辑直播课程成功！"];
        }else{
            return ['status'=>false,'message'=>"编辑直播课程失败！"];
        }
    }
}
