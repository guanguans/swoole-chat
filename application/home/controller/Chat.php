<?php
namespace app\home\controller;

use app\common\controller\HomeBase;

class Chat extends HomeBase
{
    public function _initialize()
    {
        parent::_initialize();
    }

    public function sendMessage()
    {
        /*if (empty($_POST['game_id'])) {
        return ajaxReturn(-1, '请登录！');
        }*/
        if (empty($_GET['message'])) {
            return ajaxReturn(-1, '请输入内容！');
        }

        $data = [
            'userName' => "用户" . rand(1111, 9999),
            'message'  => $_GET['message'],
        ];

        foreach ($_POST['http_object_server']->ports[1]->connections as $fd) {
            $_POST['http_object_server']->push($fd, json_encode($data));
        }

        return ajaxReturn(1, '发送成功', $data);
    }
}
