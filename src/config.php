<?php

return [
    /*
     * 默认配置，将会合并到各模块中
     */
    'defaults' => [
        /*
         * 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
         */
        'response_type'     => 'array',

        /*
         * 使用 Laravel 的缓存系统
         */
        'use_laravel_cache' => true,

        /**
         * 日志配置
         *
         * level: 日志级别, 可选为：
         *         debug/info/notice/warning/error/critical/alert/emergency
         * path：日志文件位置(绝对路径!!!)，要求可写权限
         */
        'log'               => [
            'default'  => env('APP_DEBUG', false) ? 'dev' : 'prod', // 默认使用的 channel，生产环境可以改为下面的 prod
            'channels' => [
                // 测试环境
                'dev'  => [
                    'driver' => 'single',
                    'path'   => '/tmp/micro-app.log',
                    'level'  => 'debug',
                ],
                // 生产环境
                'prod' => [
                    'driver' => 'daily',
                    'path'   => '/tmp/micro-app.log',
                    'level'  => 'info',
                ],
            ],
        ],
    ],

    'payment' => [
        'default' => [
            'debug'      => env('MICRO_PAYMENT_DEBUG', false),
            'app_id'     => env('MICRO_PAYMENT_APPID', ''),
            'mch_id'     => env('MICRO_PAYMENT_MCH_ID', 'your-mch-id'),
            'salt'       => env('MICRO_PAYMENT_SALT', 'key-for-signature'),
            'notify_url' => env('MICRO_NOTIFY_URL', 'https://example.com/payments/wechat-notify'), // 默认支付结果通知地址
        ],
    ],
];
