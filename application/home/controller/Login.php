<?php
namespace app\home\controller;

use app\common\controller\HomeBase;
use app\home\validate\Login as LoginValidate;

class Login extends HomeBase
{
    public function _initialize()
    {
        parent::_initialize();
    }

    public function login()
    {
        $validate = new LoginValidate();
        if (!$validate->check($_GET)) {
            return ajaxReturn(-1, $validate->getError());
        }
        if (cache($_GET['email']) != $_GET['authCode']) {
            return ajaxReturn(-1, '验证码错误！');
        }
        return ajaxReturn(1, '登录成功');
    }

    public function sendAuthCode()
    {
        $receiver = $_POST['email'];
        /*$email    = new Email;
        $authCode = (new LoginService())->createAuthCode($receiver);
        $result   = $email
        ->to($receiver)
        ->subject('琯琯直播')
        ->message('您的验证码是：' . $authCode)
        ->send();
        if (!$result) {
        return $email->getError();
        }*/
        $data = [
            'method' => 'sendAuthCode',
            'data'   => [
                'email' => $receiver,
            ],
        ];
        // 投递异步任务
        $_POST['http_object_server']->task($data);

        return ajaxReturn(1, '发送成功，请注意查收邮件');
    }

    public function test()
    {
        return json_encode('test');
    }
}
