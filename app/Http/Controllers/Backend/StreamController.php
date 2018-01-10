<?php

namespace App\Http\Controllers\Backend;

use App\Models\StreamModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StreamController extends Controller
{

    public function  Index() {
        return view("backend.stream.index");
    }

    // 用于被datatables请求的ajax方法
    public  function ApiList(StreamModel $streamModel,Request $request){
        // 获取所有的直播流数据,使用关联获取，with方法
        // with方法表示要关联哪一个属性with(模型里面的关联关系方法)
        $data = $streamModel -> get();
        // 获取数据总数
        $count = $streamModel -> count();
        // 把datatables的json必选项组合成数组
        $dataTables =[
            // 是否需要刷新请求次数，一般在laravel中使用request->get('draw')
            "draw"=> $request ->get('draw'),
            // 要显示的记录数有多少条
            "recordsTotal"=>$count,
            //要过滤的记录数有多少条
            "recordsFiltered"=>$count,
            // 要显示的数据源是什么
            "data" => $data
        ];
        // 直接return一个数组，laravel会自动将数组转换为json模式
        return $dataTables;
    }

    public function  Add() {
        return view("backend.stream.add");
    }


    public function Store(Request $Request){
        $data = $Request -> all();
        if( StreamModel::create($data) ){
            //如果我们的数据录入数据成功了，我们就同步我们的录入到七牛云中
            $hub = 'szphp7';//我们的直播空间名字
            $method = 'POST'; //请求七牛云的创建房间需要使用post方法
            $host = 'pili.qiniuapi.com';//请求的七牛云api地址
            $path = "/v2/hubs/{$hub}/streams";
            //直播房间（直播流）的名称
            $body = json_encode( ['key'=> $data['stream_name'] ] );
            //创建出请求鉴权的token生成
            $token = $this -> getQiunuToken($method, $host, $path, $body);
            //使用七牛云的房间生成api,发送请求
            #第1步：创建GuzzleHttp的实例
            $cli = new \GuzzleHttp\Client([
                'base_uri' => "http://{$host}"
            ]);
            //发送post到pili.qiniuapi.com中,返回psr7/reponse对象
            $reponse = $cli -> post($path,[
                'headers'=>[
                    "User-Agent" => "pili-sdk-go/v2 go1.6 darwin/amd64",
                    "Authorization" => $token,
                    "Content-Type" => "application/json",
                    "Accept-Encoding" => "gzip",
                    "Content-Length" => strlen( $body ), //房间的Json长度
                ],
                'body' => $body //房间的名称
            ]);
            //获取请求的状态码
            $code = $reponse -> getStatusCode();
            if($code == 200 ){
                return ['status'=>true,'message'=>'添加直播流（直播房间）成功!'];
            }else{
                //假设请求api失败，而数据成功，我们要删除数据库中的那条数据
                StreamModel::where('stream_name','=',$data['stream_name'])->delete();
                return ['status'=>false,'message'=>'生成直播流（直播房间）失败!'];
            }


        }else{
            return ['status'=>false,'message'=>'添加直播流（直播房间）失败!'];
        }
    }
    //复制附件目录中的七牛云Api-token目录中代码，修改如下
    private function getQiunuToken($method, $host, $path, $body){
        $contentType = 'application/json';
        $token  = "$method $path\nHost: $host\nContent-Type: $contentType\n\n$body";
        //获取你的ak
        $ak = 'UhYWJIgbXnIzPHiZdVCenSnWVksXLlOY4WBAYc91';
        //获取你的sk
        $sk = 'kVIfTnGjvMU6U9f7l5n_0cTzG4rlGh_v-MXdcKlf';
        $qiniu = new \Qiniu\Auth($ak,$sk);
        return "Qiniu " . $qiniu->sign($token);
    }



    // 编辑模板
    public  function  Edit($id){
        // 通过主键找到直播流的对应信息,返回直播流对象
        $stream = StreamModel::find($id);
        return view('backend.stream.edit')->with([
            'id' => $id, //把要修改的直播流id传值到模板当中
            "stream" => $stream ,// 把直播流赋值到模板中
        ]);
    }

    // 编辑直播流入库
    public function  Save($id,Request $request) {
        // 通过主键找到直播流的对应信息,返回直播流对象
        $subject = StreamModel::find($id);
        $data = $request ->all();
        // 在laravel5.4里面提供了一个修改白名单的方法updata
        // 修改白名单字段
        if($subject -> update($data)){
            return ['status'=>true,'message'=>"编辑直播流成功！"];
        }else{
            return ['status'=>false,'message'=>"编辑直播流失败！"];
        }
    }
}
