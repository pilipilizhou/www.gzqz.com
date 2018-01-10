<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\MembersModel;
class MembersTblSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(MembersModel $MembersModel)
    {
        //清空数据表
        $MembersModel -> truncate();
        //生成Faker对象
        $Faker = Factory::create('zh_CN');
        //生成仿真数据
        for($i=1;$i<=30;$i++){
            $sex = $i % 2 == 0  ? '男' : '女';
            $data = [
                "username"=>$Faker->username,
                'password'=>bcrypt('abc123'),
                'cnname' => $Faker -> name,
                'address' =>  $Faker -> address,
                'phone' => $Faker -> phoneNumber,
                'remark' => '测试数据填充',
                'sex' => $sex
            ];
            MembersModel::create($data);
        }
    }
}
