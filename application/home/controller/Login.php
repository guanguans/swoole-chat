<?php
namespace app\home\controller;

use app\common\controller\HomeBase;
use app\home\service\LoginService;
use app\home\validate\Login as LoginValidate;
use guanguans\Email;

class Login extends HomeBase
{
    public function _initialize()
    {
        parent::_initialize();
    }

    public function login()
    {
        $validate = new LoginValidate();
        if (!$validate->check(input('get.'))) {
            return ajaxReturn(-1, $validate->getError());
        }
        if (cache(input('get.email')) != input('get.authCode')) {
            return ajaxReturn(-1, '验证码错误！');
        }
        return ajaxReturn(1, '登录成功');
    }

    public function sendAuthCode()
    {
        $receiver = input('email');
        // $receiver = '798314049@qq.com';
        $email    = new Email;
        $authCode = (new LoginService())->createAuthCode($receiver);
        $result   = $email
            ->to($receiver)
            ->subject('琯琯直播')
            ->message('您的验证码是：' . $authCode)
            ->send();
        if (!$result) {
            return $email->getError();
        }

        return ajaxReturn(1, '发送成功，请注意查收邮件');
    }

    public function test()
    {
        return json_encode('dfdf');
    }
}
