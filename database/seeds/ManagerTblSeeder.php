<?php

use Illuminate\Database\Seeder;
#引入Faker的工厂
use Faker\Factory;
#引入orm模型
use App\Models\ManagerModel;
class ManagerTblSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ManagerModel $ManagerModel)
    {
        //获取Faker的实例,把数据生成指向中国大陆
        $Faker = Factory::create("zh_CN");
        //每一次生成数据之前，我们都把manager表的数据清空一次
        $ManagerModel -> truncate();
        //生成30个管理员的仿真测试数据
        for($i=1;$i<=30;$i++){
            $sex = $i % 2 == 0 ? "男" : "女";
            $data = [
                'username' => $Faker -> username, #生成仿真的用户名
                'password' => bcrypt('123456'), #使用bcrypt加密
                'mg_role_ids' => mt_rand(1,4), #随机生成id=1,id=2,id=3,id=4
                'mg_sex' => $sex, #随机生成男女性别
                'mg_phone' => $Faker -> phoneNumber, #生成大陆的手机号码
                'mg_email' => $Faker -> email, #生成仿真的email地址
                'mg_remark' => '都是测试数据填充的'
            ];
            ManagerModel::create( $data );
        }
    }
}
