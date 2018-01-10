<?php

use Illuminate\Database\Seeder;
use App\Models\RoleModel;
class RoleTblSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(RoleModel $RoleModel)
    {
        //清空Role表
        $RoleModel -> truncate();
        //生成测试角色数据
        $data = ['role_name' => '超级管理员'];
        RoleModel::create($data);
        $data = ['role_name' => 'php学科老师'];
        RoleModel::create($data);
        $data = ['role_name' => 'java学科老师'];
        RoleModel::create($data);
        $data = ['role_name' => 'C++学科老师'];
        RoleModel::create($data);
    }
}
