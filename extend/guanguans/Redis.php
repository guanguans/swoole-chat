<?php

namespace guanguans;

class Redis
{
    private $redis;

    private $live_game_key;

    private static $_instance = null;

    private function __construct()
    {
        try {
            ini_set('memory_limit', -1);
            $this->redis = new \Redis();
            $this->redis->connect(config('redis.host'), config('redis.port'), config('redis.timeout'));
            $this->live_game_key = config('redis.live_game_key');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    /**
     * 单例模式
     * @return [type] [description]
     */
    public static function getInstance()
    {
        if (empty(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * 添加有序集合成员
     */
    public function zadd($val)
    {
        try {
            $this->redis->zadd($this->live_game_key, 0, $val);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * 删除有序集合成员
     */
    public function zrem($val)
    {
        try {
            $this->redis->zrem($this->live_game_key, $val);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * 返回指定 key 有序集合成员
     */
    public function zrange()
    {
        try {
            $this->redis->zrange($this->live_game_key, 0, -1);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * 设置
     */
    public function set($key, $val)
    {
        try {
            $this->redis->set($key, $val);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * 获取
     */
    public function get($key, $val)
    {
        try {
            $this->redis->get($key);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
