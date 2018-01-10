<?php
/**
 * Created by qinpeizhou.
 * Date: 2017/12/17
 * Time: 20:48
 * Email : 1031219129@qq.com
 */

namespace App\Http\Controllers;




use App\Models\DemoModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;   // 浏览器的处理类
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;   // laravel的cookie
use Illuminate\Support\Facades\Session;
use DB;
use App\Models\DocumentsModel;
use App\Models\MembersModel;
use App\Models\ProfileModel;
use Illuminate\Support\Facades\Redis;

class TestController extends Controller


{

    public function  InsertTest() {
        for ($i=1;$i<=30;$i++){
            echo bcrypt(123456)."<br/>";
        }
    }



    /**
     * 上传文件
     */
    public  function  Upload(Request $Request) {
        // 获取一个上传的表单对象   <input type="file" name="img">
        $file  = $Request -> img;
        // StoreAs(模块目录，文件名称，驱动名称)
        /**
         *  比如你希望把图片保存的目录public/uploads/orders.模块目录就填orders
         *  如果不填就是直接执行public/uploads目录
         *  文件名称 ： 上传时用什么名称保存上传的文件
         *  驱动的名称： 比如要上传到亚马逊云s3，上传到在线教育平台的本地驱动就是用edu
         */
        // 获取上传文件的后缀名
        $ext = ".".$file -> getClientOriginalExtension();
        //dd($ext);
        // 定义文件上传的唯一性名称
        $filename = date("YmdHis").mt_rand(1999,9999).$ext;
        // 文件放在public/uploads
        // $res = $file ->storeAs('',$filename,'edu');
        // 如果需要把文件上传到七牛云，那么只需要修改驱动名称就行了
        $res = $file ->storeAs('',$filename,'qiniu');
        // 返回的资源一般是保持的文件名称
        dump($res);
    }

    // 显示上传的模版
    public  function FormUp(){
        return view("test.upload");
    }



    public function  In() {
        $ids = [2,4,6];
        foreach ($ids as $id){
            $sql[] = "select * from logs where id={$id}";
        }
        // 使用join把sql语句组装
        $sqlStr = join(" union all ",$sql);
        // 等于DB::fetchAll(PDO::FETCH_ASSOC);
        $data = DB::select($sqlStr);
        foreach ($data as $rs){
            echo "id={$rs->id},{$rs->title}<br />";
        }
    }

    /**
     * 显示图片
     */
    public function  Img() {
        return view('test.img')->with("img","201712201138293699.jpg");
    }

    /**
     * 队列
     */
    public function Sickers() {
        $sickers = [
            '01李四,到0006诊所就诊',
            '02张三,到0009诊所就诊',
            '03王五,到0008诊所就诊'
        ];

        foreach ($sickers as $sicker){
            // 把病人放到队列中
            Redis::rpush('Queue',$sicker);
        }
        return "挂号成功....";
    }

    public function  Doctor() {
        $sicker = Redis::lpop("Queue");
        if ($sicker){
            return $sicker;
        }else{
            return "医生下班····";
        }
    }



    public  function  TestRedis() {
        /* // 设置string类型
         Redis::set("laravel","Laravel 5.4.3");
         // 获取String类型
        echo Redis::get('laravel');*/

        // 同时设置多个
        /* Redis::mset([
             'name1'=>'itcast',
             'name2'=>'itheima',
             'name3'=>'itheima'
         ]);*/

        //设置哈希数据
        /*Redis::hmset("Player:Yao",[
            'name' => '姚明',
            'age'  => 44 ,
            'job' => '高大哥'
        ]);
        dump(Redis::hgetall("Player:Yao"));*/

        //设置张三和李四的朋友  -- 添加无序集合
        Redis:: sAdd('zsf',['杨过','小龙女','林朝英']);
        Redis:: sAdd('lsf',['杨过','周伯通','洪七公']);
        // 获取无序集合
        dump(Redis::smembers('zsf'));
        // 求并集
        dump(Redis::sunion('zsf','lsf'));
        //求交集
        dump(Redis::sinter('lsf','zsf'));
        //求差集
        dump(Redis::sdiff('zsf','lsf'));
        dump(Redis::sdiff('lsf','zsf'));
    }




    /**
     * 白名单
     * @param Request $Request
     * @param DemoModel $DemoModel
     */
    public function  Demo(Request $Request,DemoModel $DemoModel) {
        $data = $Request ->all();
        dump($DemoModel::create($data));
    }




    public function  getInfo() {
        $members1 = MembersModel::find(1);
        dump($members1 -> usename);
        echo "会员1号的属性如下所示：<br/>";
        // 在AR模式中1对1关联会被用户的数据转化为属性，属性名称跟定义的方法名称相同
        //  调用会员1号数据，要使用的是属性，因此不能使用Profile方法，要去掉()
        dump($members1 -> Profile->toArray());
        echo "会员1号的发表的评论如下所示：<br/>";
        dump($members1 -> Comments->toArray());
        echo "会员1号评论过的文章如下所示：<br/>";
        dump($members1 -> Articles->toArray());
    }





    /**
     * 利用模型操作数据库：添加
     * 添加的时候我们需要使用new DocumentsModel
     * 所以我们可以把它当成参数直接传递进来的过程就是进行实例化
     */
    public function addNews(DocumentsModel $DocumentsModel){
        // AR模式把表看成对象，因此字段就是对象属性
        // 操作documents的title字段
        $DocumentsModel -> title = "Hello Laravel";
        // 操作documents的content字段
        $DocumentsModel ->content = "This is an orm model testing";
        // orm模型在默认下，自动维护created_at和updated_at字段

        // 调用orm模型的save方法就可以实现保存功能
        dump($DocumentsModel -> save());
    }

    public function  editNews() {
        // orm模型有一个静态方法find，用于查找1条数据，默认的情况使用主键查找
        // 以下语句默认查找id=3的数据
        $DocumentsModel = DocumentsModel::find(3);
        $DocumentsModel -> title = "update lavarel title";
        $DocumentsModel -> content = "update lavarel content";
        // 调用orm模型的save方法就可以实现保存功能
        dump($DocumentsModel -> save());
    }


    public function  delNews() {
        // orm模型有一个静态方法find，用于查找1条数据，默认的情况使用主键查找
        // 以下语句默认查找id=4的数据
        $DocumentsModel = DocumentsModel::find(4);
        // 调用orm模型中delete方法删除
        dump($DocumentsModel -> delete());
    }

    /**
     * 使用orm方式查询
     * 使用all和get获取所有的数据
     */
//    public function  getNews(DocumentsModel $DocumentsModel) {
//        // 使用all获取全部
//      /*  $data = DocumentsModel::all();
//        foreach ($data as $rs){
//              echo $rs -> title ."内容:".$rs->content;
//              echo "<br/>";
//        }
//
//       // 转成数组
//        dump($data->toArray());*/
//
//
//        // 使用get获取根据条件查询的所有数据
//        // 可以发生向下兼容laravel5.1
//        dump($DocumentsModel -> where("id",">",1)->get());
//
//    }


    /**
     * 5.4的写法
     */
//    public function  getNews() {
//        dump(DocumentsModel::where("id",">",1)->get()->toArray());
//    }

    /**
     * 使用find和 根据主键查找一条数据
     */

//    public function  getNews() {
//        dump(DocumentsModel::find(3)->toArray());
//    }



    /**
     * 使用first和 根据主键查找第一条数据
     */

//    public function  getNews() {
//        dump(DocumentsModel::first()->toArray());
//    }


    public function  getNews() {

    }



    /**
     * 获取学生的方法
     */
    public function GetStudents() {
        // 获取数据，使用连贯操作
        $data = DB::table('Students')->get();
        dump($data);
        foreach ($data as $rs){
            $str = "学号:".$rs->sid;
            $str .= ",姓名:".$rs->name;
            $str .= ",年龄:".$rs->age. ",学校:".$rs->school;
            echo $str."<br/>";
        }
    }

    /**
     * 获取第一条数据
     */
    public function GetOne() {
        $data = DB::table("Students")->first();
        return "学号:".$data->sid."姓名:".$data->name."年龄:".$data->age."学校:".$data->school;
    }

    /**
     * 插入一条数据
     */
    public function  InsertOne(){
        $data = [
            "sid"=>"s666",
            "name"=>"惠州",
            "age"=>30,
            "school"=>"惠州大学"
        ];
        dump(DB::table("Students")->insert($data));
    }

    /**
     * 修改一条数据
     */
    public function EditStu() {
        $student = [
            "name"=>"小惠州",
            'age'=>12,
            "school"=>'惠州小学'
        ];
        dump(DB::table("Students")->where("sid","=","s666")->update($student));
    }

    /**
     * 删除一个学生，没有条件的话默认删除所有学生
     */
    public function DelStu() {
        dump(DB::table("Students")->where("age",'<',30)->delete());
    }

    /**
     * 根据传入参数查找数据
     * */
    public function Search($sid=null) {
        if($sid != null ) {
            $student = DB::table("students")->where("sid","=",$sid)->first();
            return "学号:".$student->sid."姓名:".$student->name."年龄:".$student->age."学校:".$student->school;
        }else {
            $data = DB::table('Students')->get();
            foreach ($data as $rs){
                $str = "学号:".$rs->sid;
                $str .= ",姓名:".$rs->name;
                $str .= ",年龄:".$rs->age. ",学校:".$rs->school;
                echo $str."<br/>";
            }
        }
    }

    /**
     * 查询特定条件下的多条数据 -- or操作
     */
    public function getByWhere()
    {
        $data = DB::table("sorces")->where("sorce", "=", 90)->orWhere("sorce", "=", 70)->get();
        dump($data);
        $data2 = DB::table("sorces")->where("sorce","=",70)->where("profession","=","英语")->get();
        dump($data2);
    }





    public function OA(){
        return view('oa.index');
    }
    public function Adidas(){
        return view('history.adidas');
    }
    public function Nike(){
        return view('history.nike');
    }

    public function FormUpload(){
//         return view('backend.login');
        return view('oa.demo');
    }

    // 实例化Request类，把该类传值到方法参数中laravel就会自动实例化
    public function Login(Request $Request) {
        //获取表达的所有传值
//         $data = $Request -> all();
        $data = $Request -> only(['username','pwd','vcode']);
        dump($data);
    }


    /**
    写入Cookie
     */
    public function  TestCk(Response $Response) {
        /**        // 生成cookie对象
        $ck = Cookie::make('username','itcast',2);
        // 使用response对象把cookie放置到浏览器端
        $Response -> withCookie($ck);
        //         把ob缓存中的cookie的数据输出到浏览器端
        return $Response;
         *
         * */

        /*$ck = Cookie::queue("username","itcast");
        // 同时把cookie传递过去
        return view("backend.login")->withCookie($ck);
        */

        // 5年，永久cookie
        /* $ck = Cookie::forever("lover","sasa");
         $Response -> withCookie($ck);
         return $Response;*/

        // 存储一个数组
        /*$ck1 = Cookie::make('data[username]',"sasa");
        $ck2 = Cookie::make('data[age]',"18");
        $Response -> withCookie($ck1);*/

        $ck3 = Cookie::make('shuzu',['username'=> 'sasaShuZu','age'=>189]);
        $Response -> withCookie($ck3);
        return $Response;
    }


    /**
    读取cookie
     */
    public function  ReadCk(Request $Request,Response $Response) {
        /*  $ck = Cookie::forget("lover");
          $Response->withCookie($ck);
          return $Response;*/
        // 返回一个数组
        dump($Request -> cookie('shuzu')) ;
    }


    public function setSession(Request $Request) {
        @session_start();
        $_SESSION['username'] = "sasa";
        $Request -> session() ->put("username",'itheima');

        // session 存储数组
        $data = ["username"=>"admin","userid"=>1000,"age"=>34];
        $Request -> session() -> put("userInfo",$data);
    }

    public function GetSession(Request $Request) {
        @session_start();
        dump($_SESSION);
        // 删除一条
        $Request -> session() -> forget("userInfo");
        // 删除所有，连token也删除了
        $Request -> session() -> flash();
        dump($Request -> session() ->all());
        dump($Request -> session() ->get("username"));
        dump($Request -> session() ->has("username"));
        dump($Request -> session() ->has("lalalal"));
    }

}
