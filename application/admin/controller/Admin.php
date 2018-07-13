<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;

class Admin extends AdminBase
{
    public function _initialize()
    {
        parent::_initialize();
    }

    public function pushMessage()
    {
        $_POST['http_object_server']->push(7, '测试测试');

        return json_encode($_GET);
    }
}
