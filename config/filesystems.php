<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => 'local',

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => 's3',

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "s3", "rackspace"
    |
    */

    'disks' => [
         // 在线教育平台的本地存储驱动
        'edu' => [
            'driver' => 'local',
            'root' => "uploads", #等同于public/uploads目录
        ],

        'qiniu' => [
            'driver' => 'qiniu',
            // 加上域名，注意是http协议
            'domain' => 'http://p18p4bcgp.bkt.clouddn.com',          //你的七牛域名，支持 http 和 https，也可以不带协议，默认 http
            // ak
            'access_key'    => '4GR70l2oaTnXCfXLtpe8BstkjKDJTE7NsNSFlocu',                          //AccessKey
            // sk
            'secret_key' => 'rf7UoxaN6nml-1J3qLAPODBfuTJoD7oVUeG6MlAW',                             //SecretKey
            'bucket' => 'gzqz1317',  //牛的名字：Bucket名字
        ],
        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_KEY'),
            'secret' => env('AWS_SECRET'),
            'region' => env('AWS_REGION'),
            'bucket' => env('AWS_BUCKET'),
        ],

    ],

];
