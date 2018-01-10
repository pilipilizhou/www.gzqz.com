<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploaderController extends Controller
{
    public function Upload(Request $Request){
        // 获取webuploader对象
        $file  = $Request ->uploader;
        // 获取上传文件的后缀名
        $ext = ".".$file -> getClientOriginalExtension();
        // 生成唯一的文件名
        $filename = date('YmdHis').mt_rand(1999,99999)."$ext";
        // 上传到本地public/upload
//         $res = $file ->storeAs('',$filename,'edu');
        // 如果需要把文件上传到七牛云，那么只需要修改驱动名称就行了
        $res = $file ->storeAs('',$filename,'qiniu');
        if($res){
            return ['status'=>true,'message'=>'上传成功!','file'=>$res];
        }else{
            return ['status'=>false,'message'=>'上传失败!'];
        }
    }
}
