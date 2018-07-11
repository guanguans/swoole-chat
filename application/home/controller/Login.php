<?php
namespace app\home\controller;

use app\common\controller\Home;

class Login extends Home
{
    public function _initialize()
    {
        parent::_initialize();
    }

    public function login()
    {
        $validate = new \app\home\validate\Login();
        if (!$validate->check(input('get.'))) {
            return ajaxReturn(-1, $validate->getError());
        }
        /*if (!checkAuthCode()) {
        return ajaxReturn(1, '验证码不正确！');
        }*/

        return ajaxReturn(1, '登录成功');
    }

    public function authCode()
    {
        return ajaxReturn(1, '发送成功，请登录邮箱查看验证码');
    }
}
