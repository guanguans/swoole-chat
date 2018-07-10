<?php
/**
 * http_server
 */
$http = new swoole_http_server("0.0.0.0", 8888);

$http->set(
    [
        'enable_static_handler' => true,
        'document_root'         => "/home/vagrant/code/think/public/static/home",
        'worker_num'            => 3,
    ]
);
$http->on('WorkerStart', function ($serv, $worker_id) {
    // 加载基础文件
    require __DIR__ . '/../thinkphp/base.php';
});
$http->on('request', function ($request, $response) use ($http) {
    $_SERVER = [];
    if (isset($request->server)) {
        foreach ($request->server as $k => $v) {
            $_SERVER[strtoupper($k)] = $v;

        }
    }
    if (isset($request)) {
        foreach ($request->header as $k => $v) {
            $_SERVER[$k] = $v;
        }
    }
    $_SERVER['argv'][0] = '';

    $_POST = [];
    if (isset($request->post)) {
        foreach ($request->post as $k => $v) {
            $_POST[$k] = $v;
        }
    }

    $_GET = [];
    if (isset($request->get)) {
        foreach ($request->get as $k => $v) {
            $_GET[$k] = $v;
        }
    }

    $_FILES = [];
    if (isset($request->files)) {
        foreach ($request->files as $k => $v) {
            $_FILES[$k] = $v;
        }
    }

    $_COOKIE = [];
    if (isset($request->cookie)) {
        foreach ($request->cookie as $k => $v) {
            $_COOKIE[$k] = $v;
        }
    }

    ob_start();
    try {
        // 执行应用并响应
        think\Container::get('app')->run()->send();
    } catch (\Exception $e) {
        print_r($e->getError());
    }
    // echo "--action--" . request()->action() . PHP_EOL;
    $res = ob_get_contents();
    ob_end_clean();
    $response->end($res);
    // $http->close($request->fd);

});
// http://192.168.10.10:8888/?s=index/index/hello 以这种方式请求
$http->start();
