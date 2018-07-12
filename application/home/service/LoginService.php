<?php
namespace app\home\service;

class LoginService
{
    public function createAuthCode($email)
    {
        $code = rand(1000, 9999);
        cache($email, $code, 60 * 60);

        return $code;
    }
}
