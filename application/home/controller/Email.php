<?php
namespace app\home\controller;

class Email
{
    public function authCode()
    {
        return ajaxReturn(1, '发送成功，请登录邮箱查看验证码');
    }
}
