<?php

namespace App\Http\Controllers\Home;

use App\Models\CourseModel;
use App\Models\OrderModel;
use App\Models\PayRecodeModel;
use App\Models\ProfessionalModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller
{
    // 购买专业的订单确认页面
    public function Sure($type, $id){
        $goodsInfo = $this -> type($type, $id);
        return view('home.order.sure')->with([
            'goodsInfo' => $goodsInfo
        ]);
    }
    public function type($type,$id){
        $type = strtolower($type);
        if( $type == 'profession' ){
            $goods = new ProfessionalModel();
        }else if ($type == 'course'){
            $goods = new CourseModel();
        }
        return $goods->find( $id );
    }

    // 生成(专业)订单
    public function make($type, $id, OrderModel $order){
        // 判断购买用户是否已经登录了。如果没有登录，则跳转到登录页面。

       $goods = $this->type($type, $id);
        // 创建订单
        $res = $order->create([
            'order_number' => $this->order_number(), // 订单号
            'status' => 0,   // 订单状态
            'profession_id'=> $goods->profession_name?$goods->id:null,
            'course_id' => $goods->course_name?$goods->id:null,
            'member_id' => \Auth::guard('memberAuth')->user()->id,   // 会员ID
            'order_name' => $goods->profession_name?$goods->profession_name:$goods->course_name,
            'price' => round($goods->price - $goods->sale_price, 2), // 订单号
        ]);

        if( $res ){
            // 生成订单成功！
            return redirect('Home/Order/pay/' . $res->id );
        }else{
            // 生成订单失败！
            return redirect()->back()->withErrors('生成订单失败！请重新确认订单');
        }

    }

    // 生成一个唯一的订单号
    public function order_number(){
        $number = 1;
        if( Redis::get('order_number') ){
            $number =  Redis::incr('order_number'); // 自增 ++;
        }else{
            Redis::set('order_number',1);
        }
        $order_number = intval(microtime(true) * 10000) . str_pad($number,5,'0',STR_PAD_LEFT);
        return $order_number;
    }

    // 发起支付
    public function pay(OrderModel $order){
        $data['orderInfo'] = $order;
        return view('home.order.pay', $data);
    }

    // 微信支付
    public function wxpay(OrderModel $order){
        $data['orderInfo'] = $order;
        // 因为我们域名指向的根目录是public里面，所以我们要重新调整路径
        require_once "../wxpay/lib/WxPay.Api.php";
        require_once "../wxpay/example/WxPay.NativePay.php";
        // 实例化扫码支付工具类
        $notify = new \NativePay();
        // 组装发起微信支付的url地址
        $input = new \WxPayUnifiedOrder();
        $input->SetBody( $order->order_name ); // 订单名称
        // $input->SetAttach("test"); // 附加数据
        $input->SetOut_trade_no( $order->order_number ); // 订单号
        $input->SetTotal_fee( $order->price * 100 );    // 订单总金额，单位为分
        $input->SetTime_start( date("YmdHis", strtotime($order->created_at) ) );          // 交易开始时间
        $input->SetTime_expire(date("YmdHis", strtotime($order->created_at) + 24 * 3600) ); // 交易结束时间
        // $input->SetGoods_tag("test");
        //  post回调地址，这个地址必须在公网上可以访问。
        $input->SetNotify_url("http://paysdk.weixin.qq.com/example/notify.php");
        $input->SetTrade_type("NATIVE");     // 交易类型 [NATIVE表示扫码支付]
        $input->SetProduct_id( $order->profession_id?$order->profession_id:$order->course_id );
        $result = $notify->GetPayUrl( $input );
        if( isset($result["code_url"]) ){
            $data['url'] = urlencode($result["code_url"]);
            return view('home.order.wxpay', $data);
        }

    }

    // 查询当前订单的支付结果
    public function query(OrderModel $order, PayRecodeModel $pay_recode, ProfessionalModel $profession, CourseModel $course){
        // 调用微信支付的功能到微信支付的服务器中查询当前订单的状态
        require_once "../wxpay/lib/WxPay.Api.php";
        $out_trade_no = $order->order_number;
        $input = new \WxPayOrderQuery();
        $input->SetOut_trade_no($out_trade_no);
        $res = \WxPayApi::orderQuery($input); // 订单查询的结果
        if( isset( $res['trade_state'] ) &&  $res['trade_state'] ==='SUCCESS'  ){
            // 修改订单的状态
            $order->status = 1;
            $order->pay_at = date('Y-m-d H:i:s',strtotime($res['time_end']) );
            $order->save();
            // 还要记录会员购买课程/专业的记录，包括了当前会员购买了课程以后的有效期
            // 获取当前课程/专业的有效天数
            if( $order->profession_id ){
                // 购买的是专业
                $goods = $profession->find( $order->profession_id );
            }else{
                // 购买的是课程
                $goods = $course->find( $order->course_id );
            }
            // 增加专业或课程的报读人数
            $goods->number = $goods->number + 1;
            $goods->save();

            $pay_recode->create([
                'profession_id' => $order->profession_id,
                'course_id'     => $order->course_id,
                'member_id'     => \Auth::guard('memberAuth')->user()->member_id,
                'expire_start'  => date('Y-m-d H:i:s',strtotime($res['time_end']) ),
                'expire_end'    => date('Y-m-d H:i:s',strtotime($res['time_end']) + $goods->expire_at * 86400 ),
            ]);
            return ['status'=>true,'error'=>1,'message'=>'支付成功！'];
        }
        return ['status'=>false,'error'=>0,'message'=>'未支付！'];
    }

}
