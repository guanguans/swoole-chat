<?php

namespace guanguans;

class Redis
{
    private $redis;

    private static $_instance = null;

    private function __construct()
    {
        $this->redis = new \Redis();
        $result      = $this->redis->connect(config('redis.host'), config('redis.port'), config('redis.timeOut'));
        if ($result === false) {
            throw new \Exception('redis connect error');
        }
    }

    public static function getInstance()
    {
        if (empty(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function zAdd($key, $val)
    {
        try {
            $this->redis->zAdd($key, 0, $val);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
