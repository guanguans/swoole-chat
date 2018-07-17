<?php
namespace app\common\service;

use app\home\service\LoginService;
use guanguans\Email;

/**
 * swoole 异步 task 任务处理类
 */
class TaskService
{
    public function __construct()
    {
    }

    public function sendAuthCode($data, $serv)
    {
        try {
            $receiver = $data['email'];
            $email    = new Email;
            $authCode = (new LoginService())->createAuthCode($receiver);
            $result   = $email
                ->to($receiver)
                ->subject('琯琯直播')
                ->message('您的验证码是：' . $authCode)
                ->send();
            if (!$result) {
                // todo 日志记录
                return $email->getError();
            }
        } catch (\Exception $e) {
            // todo 日志记录
            return $e->getMessage();
        }
    }

    public function pushLive($data, $serv)
    {
        try {
            $fds = \guanguans\Redis::getInstance()->zrange();

            foreach ($fds as $vo) {
                $serv->push($vo, json_encode($data));
            }
        } catch (\Exception $e) {
            // todo 日志记录
            return $e->getMessage();
        }
    }
}
