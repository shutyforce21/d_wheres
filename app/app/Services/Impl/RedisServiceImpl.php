<?php


namespace App\Services\Impl;


use App\Services\Interfaces\RedisService;
use Illuminate\Support\Facades\Redis;

class RedisServiceImpl implements RedisService
{
    private $redis = null;

    public function __construct()
    {
        $this->redis = Redis::connection('db2');
    }

    public function setKey1($value)
    {
        Redis::set('key1', 'default_' . $value);
        $this->redis->set('key1', 'db2_' . $value);
    }

    public function getKey1()
    {
        $default = Redis::get('key1');
        $db2 = $this->redis->get('key1');

        return [$default, $db2];

    }
}
