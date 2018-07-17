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
        if (empty($_GET['content'])) {
            return ajaxReturn(-1, '推送失败！');
        }
        $teams = [
            1 => [
                'name' => '马刺',
                'logo' => '/live/imgs/team1.png',
            ],
            4 => [
                'name' => '火箭',
                'logo' => '/live/imgs/team2.png',
            ],
        ];

        $data = [
            'type'    => intval($_GET['type']),
            'title'   => !empty($teams[$_GET['team_id']]['name']) ? $teams[$_GET['team_id']]['name'] : '直播员',
            'logo'    => !empty($teams[$_GET['team_id']]['logo']) ? $teams[$_GET['team_id']]['logo'] : '',
            'content' => !empty($_GET['content']) ? $_GET['content'] : '',
            'image'   => !empty($_GET['image']) ? $_GET['image'] : '',
        ];

        $taskData = [
            'method' => 'pushLive',
            'data'   => $data,
        ];
        $_POST['http_object_server']->task($taskData);

        return ajaxReturn(1, '推送成功');
    }
}
