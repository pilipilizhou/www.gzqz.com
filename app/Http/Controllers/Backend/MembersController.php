<?php

namespace App\Http\Controllers\Backend;

use App\Models\MembersModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MembersController extends Controller
{
    public function Index(){
        return view('backend.members.index');
    }

    // 用于被datatables请求的ajax方法
    public  function ApiList(MembersModel $membersModel,Request $request){
        // 获取所有的管理员数据,使用关联获取，with方法
        // with方法表示要关联哪一个属性with(模型里面的关联关系方法)
        $data = $membersModel-> get();
        // 获取数据总数
        $count = $membersModel -> count();
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

    // 删除管会员，使用member_id
    public function Remove($member_id) {
        // 找到要删除的会员，然后删除
        $member = MembersModel::find($member_id);
        // 调用删除方法
        if($member -> delete()) {
            // 删除成功，返回json[status:true,message:'成功删除会员！']
            return ['status'=>true,"message"=>'成功删除会员！'];
        }else{
            return ['status'=>false,"message"=>'删除会员失败！'];
        }
    }


    // 编辑模板
    public  function  Edit($member_id){
        // 通过主键找到管理员的对应信息,返回管理员对象
        $member = MembersModel::find($member_id);
        return view('backend.members.edit')->with([
            'member_id' => $member_id, //把要修改的管理员id传值到模板当中
            "member" => $member // 把管理员赋值到模板中
        ]);
    }


    // 编辑会员入库
    public function  Save($member_id,Request $request) {
        // 通过主键找到会员的对应信息,返回会员对象
        $member = MembersModel::find($member_id);
        // all() 提交的数据[mg_sexmg_email,mg_remark,mg_phone]
        $data = $request ->all();
        // 在laravel5.4里面提供了一个修改白名单的方法updata
        // 修改白名单字段
        if($member -> update($data)){
            return ['status'=>true,'message'=>"编辑会员成功！"];
        }else{
            return ['status'=>false,'message'=>"编辑会员失败！"];
        }
    }
}
