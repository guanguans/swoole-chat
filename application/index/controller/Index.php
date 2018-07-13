<?php
namespace app\index\controller;

class Index
{
    public function index()
    {
        // 面向对象返回空
        return '';
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}
