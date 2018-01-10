<?php

namespace App\Http\Controllers\home;

use App\Models\CourseModel;
use App\Models\OrderModel;
use App\Models\ProfessionalModel;
use App\Models\TeachersModel;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfessionController extends Controller
{
    public function  Detail($profession_id,ProfessionalModel $professionalModel,TeachersModel $teachersModel,OrderModel $orderModel){
         $professionInfo  = $professionalModel->where('id',$profession_id)->with(['Course'=>function($query){
             return $query->with('Lesson');
         }])->first();
         $teacher_list = $teachersModel->select('cnname')->whereIn('teacher_id',explode(',',$professionInfo->teacher_ids))->get()->toArray();
         $teachers = [];
         foreach ($teacher_list as $teacher){
                 $teachers[] = $teacher['cnname'];
         }
        $professionInfo->teacher_ids = implode(',',$teachers);


         if(isset(Auth::guard('memberAuth')->user()->id)){
             $member_id = Auth::guard('memberAuth')->user()->id;
             /*
              * 判读课程是否重复购买：
              * 1.根据profession_id和Auth.id 来  去订单表查询
              * */
             // 根据id查询该用户该专业课程的订单
             $buyObjects= $orderModel->where("profession_id", $professionInfo->id)->where("member_id", $member_id)->get();
             if(count($buyObjects)){  // 是否已经购买或者下单没付款 -- 判断查询的数组是否为空
                 // 2.判断课程是否过期 ，如果 [将课程的有效天数和现在购买时间对比付款时间+有效天数 > 现在] 那么课程不付款，直接可以学习
                 // 有效天数
                 $expire_at = $professionInfo->expire_at;
                 // 有效天数转变成秒数:  有效天数 * 24*60*60
                 // 已经过期的已付款订单可以购买，还没有过期的不可以下单购买
                 $expire_at = $expire_at * 24*60*60;
                 foreach ($buyObjects as $buyObject){
                   if($buyObject->status == 1){    // 订单已经付款
                       // 付款时间
                       $pay_at = $buyObject->pay_at;
                       // 把付款时间转为时间戳再加上有效天数的秒数
                       $dt = new \DateTime($pay_at);
                       $time = $dt ->format("U");
                       // 秒数相加就是订单过期时间    已付款订单过期时间 = 订单付款时间 + 有效时间段
                       $time = $time + $expire_at;
                       // 获取当前时间的时间戳，用来和订单的过期时间的时间戳对比
                       $dt3 = new \DateTime();
                       $nowTime = $dt3->format('U');
                       if($time > $nowTime){ //  还没有过期,不能购买
                           $buyState = "cannotBuy";
                       }else{    // 已过期可以购买/续期
                           $buyState = "canBuy";
                       }
                   }else{ // 订单还没有付款
                       // 按钮变成付款
                       $buyState = "payMoney";
                   }
                    //$dt2 = date('Y-m-d H:i:s',$time);    // 格式化时间
                 }
             }else{
                 $buyState = "canBuy";
             }
         }else{
             $buyState = "canBuy";
         }

        return view('home.profession.detail')->with([
            'professionInfo'=>$professionInfo,
            'buyState'=>$buyState
        ]);
    }


    /**获取专业内容
     * @param $profession_id
     */
    public function professionContent($profession_id,ProfessionalModel $professionalModel){
         $content =  $professionalModel->where('id',$profession_id)->first(['content']);
         if(isset($content->content)){
             return ["status"=>true,'professionContent'=>$content->content];
         }else{
             return ["status"=>false,'professionContent'=>"暂无该专业课程的介绍..."];
         }


    }


    /**获取专业教师详情
     * @param $profession_id
     */
    public function professionTeachers($profession_id,TeachersModel $teachersModel,ProfessionalModel $professionalModel){
        $professionTeachers  = $professionalModel->where('id',$profession_id)->first(['teacher_ids']);
        $teacher_list = $teachersModel->select(['avatar','cnname','remark'])->whereIn('teacher_id',explode(',',$professionTeachers->teacher_ids))->get();
        return ["status"=>true,'professionTeachers'=>$teacher_list];


    }
}
