<?php
// 生成 admin 模块 php think build
return [
    'admin' => [
        '__dir__'    => ['controller', 'model', 'view', 'validate'],
        'controller' => ['User'],
        'model'      => ['User'],
        'validate'   => ['User'],
        'view'       => ['user/index', 'user/read', 'user/create_edit'],
    ],
];
