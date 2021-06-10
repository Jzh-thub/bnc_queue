<?php
// +----------------------------------------------------------------------
// | CoreApi
// +----------------------------------------------------------------------
// | 开源协议  https://mit-license.org
// +----------------------------------------------------------------------
use think\facade\Env;

return [
    'default'     => 'redis',
    'prefix'      => 'core_',
    'connections' => [
        'sync'     => [
            'type' => 'sync',
        ],
        'database' => [
            'type'  => 'database',
            'queue' => 'default',
            'table' => 'jobs'
        ],
        'redis'    => [
            'type'       => 'redis',
            'queue'      => 'CORE',
            'host'       => Env::get('redis.redis_hostname', '127.0.0.1'),
            'port'       => Env::get('redis.port', 6379),
            'password'   => Env::get('redis.redis_password', ''),
            'select'     => Env::get('redis.select', 0),
            'timeout'    => 0,
            'persistent' => false
        ]
    ],
    'failed'      => [
        'type'  => 'none',
        'table' => 'failed_jobs'
    ]
];
