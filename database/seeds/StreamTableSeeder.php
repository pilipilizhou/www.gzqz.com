<?php

use Illuminate\Database\Seeder;
use App\Models\StreamModel as Stream;
class StreamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Stream $stream)
    {
        // 清空数据表
        $stream->truncate();
        $stream->create(['stream_name'=>'itcast']);
    }
}
