<?php
namespace app\home\controller;

class Email
{
    public function authCode()
    {
        $data = [
            'code'    => 1,
            'message' => '发送成功',
            'data'    => [
                'authCode' => 1234,
            ],
        ];

        return json_encode($data);
    }
}
