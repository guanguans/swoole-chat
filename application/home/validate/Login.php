<?php

namespace app\home\validate;

use think\Validate;

class Login extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'    =>    ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'email'    => 'require|email',
        'authCode' => 'require|number|length:4',
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'    =>    '错误信息'
     *
     * @var array
     */
    protected $message = [
        'email.require'    => '邮箱不能为空！',
        'email.email'      => '邮箱格式不正确！',
        'authCode.require' => '验证码不能为空',
        'authCode.number'  => '验证码必须是数字',
        'authCode.length'  => '验证码必须是4位数字',
    ];
}
