<?php
namespace app\home\controller;

class Login
{
    public function login()
    {
        // return json_encode($_GET['email']);
        $email    = $_GET['email'];
        $authCode = $_GET['authCode'];

        if (empty($email)) {
            return ajaxReturn(-1, '邮箱不能为空！');
        }

        if (empty($authCode)) {
            return ajaxReturn(-1, '验证码不能为空！');
        }

        return ajaxReturn(1, '登录成功');
    }
}
