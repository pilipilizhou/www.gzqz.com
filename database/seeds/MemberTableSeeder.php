<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\MemberModel;
class MemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run( MemberModel $member )
    {
        $faker = Factory::create('zh_CN');
        for( $i = 0; $i<100;$i++ ){
            $member->create([
                'type' => mt_rand(1,2),
                'username'=> $faker->unique()->userName, // 生成为一个唯一的昵称
                'nickname'=> $faker->unique()->name,
                'sex'     => mt_rand(1,2),
                'password'=> bcrypt('123456'),
                'email'   => $faker->unique()->email,
                'phone'   => $faker->unique()->phoneNumber,
                'login_rec' => mt_rand(0,1000),
                'login_ip'  => $faker->ipv4,
            ]);
        }
    }
}
