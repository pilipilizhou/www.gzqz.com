<?php

namespace App\Http\Controllers\Home;

use App\Models\CourseModel;
use App\Models\LiveModel;
use App\Models\MemberModel;
use App\Models\MembersModel;
use App\Models\ProfessionalModel;
use App\Models\SubjectModel;
use App\Models\TeachersModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class MembersController extends Controller
{

    //显示登录/注册页面
    public function Login() {
        return view("home.members.login_register");
    }

    public function Welcome(Request $request,SubjectModel $subject, ProfessionalModel $profession, TeachersModel $techersModel, LiveModel $live){
        // 所有的学科
        $data['subjectList'] = $subject->get();
        // 所有的专业
        $list = $profession->get()->toArray();
        foreach($list as $key => $item){
            $techers = $techersModel->select('cnname')->whereIn('teacher_id',explode(',',$item['teacher_ids']))->get()->toArray(); // 转换成数组
            $techerslist = [];
            foreach($techers as $k => $i){
                if($k > 2){
                    break;
                }
                $techerslist[] = $i['cnname'];
            }
            $list[$key]['teacher_ids'] = implode( ',',$techerslist );
        }
        $data['professionList'] = $list;
        // 直播课程[过滤掉哪些已经过期的直播]
        $data['liveList'] = $live->where( 'end_at', '>', date('Y-m-d H:i:s') )->orderBy('start_at','asc')->limit(4)->get();
        if(isset( Auth::guard('memberAuth')->user()->nickname)){
             $data['nickname'] = Auth::guard('memberAuth')->user()->nickname;
        }


        
        // 获取前4个排序最高的推荐课程   推荐is_recommend+ 排序 sort
        $list2 = $bestProfession = $profession->where("is_recommend",1)->orderBy("sort",'desc')->limit(4)->get();
        foreach($list2 as $key => $item) {
            $techers = $techersModel->select('cnname')->whereIn('teacher_id', explode(',', $item['teacher_ids']))->get()->toArray(); // 转换成数组
            $techerslist = [];
            foreach ($techers as $k => $i) {
                if ($k > 2) {
                    break;
                }
                $techerslist[] = $i['cnname'];
            }
            $list2[$key]['teacher_ids'] = implode(',', $techerslist);
        }
        $data['recommend_professions'] = $list2;

        return view('home.index',$data);
    }


    
    public function  AjaxLogin(Request $request) {
        // 获取用户名和密码
        $info = $request->only(['username','password']);
        if(Auth::guard('memberAuth')->attempt(['username'=>$info['username'],'password'=>$info['password']])) {
            // 标注当前登录成功
            $request -> session()-> put('login','okey');
            //登录成功跳转的地址
            return ['status'=>true,'url'=>'/Home/Members/Welcome'];
        }else{
            // 登录失败
            return ['status'=>false,'message'=>'用户名或者密码错误'];
        }
    }


    // 会员中心
    public function index(){
        return view('home.members.index');
    }


    // 登录
    public function checkLogin(Request $request){
        // 接收数据
        $username  = $request->input('username');
        $password = $request->input('password');
        // 完成登录功能
        $res1 = Auth::guard('memberAuth')->attempt(['username'=>$username,'password'=>$password]);
        // 多个条件实现登录
        $res2 = Auth::guard('memberAuth')->attempt(['phone'=>$username,'password'=>$password]);
        $res3 = Auth::guard('memberAuth')->attempt(['email'=>$username,'password'=>$password]);

        if( $res1 || $res2 || $res3 ){
            return ['success'=>true,'url'=>'/'];
        }else{
            return ['success'=>false,'errorMessage'=>'用户名或者密码错误'];
        }
    }
//
//    // 使用邮箱注册
//    public function register(Request $request){
//        $userInfo = $request->all() ;
//        if(strpos($userInfo['username'],"@")) {    // 是邮箱
//              $userInfo['email'] = $userInfo['username'];
//        }else{ // 是手机号码
//            $userInfo['phone'] = $userInfo['username'];
//        }
//        if(MemberModel::create($userInfo)) {
//              return ['success'=>true,'url'=>'/Home/Members/Login'];
//        }else{
//            return ['success'=>false,'errorMessage'=>'注册失败！'];
//        }
//    }


    // 使用手机注册：提交表单数据和注册
    public function  phoneRegist(Request $request) {
        $userInfo = $request ->all();
        $userInfo['password'] = bcrypt($userInfo['password']);
        if(isset($userInfo['code'])){
            $useCode = $userInfo['code'];
            $sessionCode = $request->session()->get('sms_code');
            if($sessionCode){
                if($useCode == $sessionCode){
                    // 填写手机号
                    $userInfo['phone'] = $userInfo['username'];
                    if(MemberModel::create($userInfo)) {
                        return ['success'=>true,'url'=>'/Home/Members/Login'];
                    }else{
                        return ['success'=>false,'errorMessage'=>'注册失败！'];
                    }
                }else{
                    return ['success'=>false,'errorMessage'=>'验证码输入不正确！'];
                }
            }
        }else{
            if(strpos($userInfo['username'],"@")) {    // 是邮箱
                $userInfo['email'] = $userInfo['username'];
            }else{ // 是手机号码
                $userInfo['phone'] = $userInfo['username'];
            }
            if(MemberModel::create($userInfo)) {
                return ['success'=>true,'url'=>'/Home/Members/Login'];
            }else{
                return ['success'=>false,'errorMessage'=>'注册失败！'];
            }
        }



    }

    // 校验注册的用户名是否已经被注册了
    public function  checkNickName(Request $request,MemberModel $memberModel){
        $nickname = $request->input('nickName');
        if($memberModel->where('nickname',$nickname)->first()) {
            return ['status'=>true];
        }else{
            return ['status'=>false];
        }
    }

    // 发送短信验证码
    public function  sendSMSCode(Request $request,MemberModel $memberModel) {
         $phone =  $request->input('phone');
         // 校验是否已经存在该手机号码
        if($memberModel->where('phone',$phone)->first()) {
            return ['success'=>false,'errorMessage'=>'该手机号已注册，请直接登录！'];
        }else{
            // 发送验证码
            $sms_code =  $this->generate_code(6);
            $tpl = [
                'Aliyun' => 'SMS_120366290'
            ];
            $data = [
                'code' =>$sms_code,
            ];
            //to方法:表示要发给哪个手机号码
            //template方法:表示使用哪个一个前面模板
            //data:对短信模板的变量进行赋值操作
            //send:发送短信
            $res = \PhpSms::make() -> to($phone) -> template($tpl) -> data($data) -> send();
            if( $res['success'] ){
                // 发送短信成功，把短信存进session里面
                $request->session()->put('sms_code', $sms_code);//存储信息
                return ['success'=>true];
            }else{
                return ['success'=>false,'errorMessage'=>'发送验证码失败'];
            }
        }
    }


    /**生成6为随机数的验证码
     * @param int $length
     * @return int
     */
    function generate_code($length = 6) {
        return rand(pow(10,($length-1)), pow(10,$length)-1);
    }

//    // 退出登录
//    public function logout(){
//        Auth::guard('memberAuth')->logout();
//        return redirect('/login_register')->withErrors('退出登录成功！');
//    }
    // 退出系统登录页
    public function logout(){
        // 用户认证的退出登录方法
        Auth::guard('memberAuth')->logout();
        return ['status'=>true,"message"=>'退出成功！'];
    }


    
}
