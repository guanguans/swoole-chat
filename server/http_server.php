<?php
/**
 * http_server
 */
$http = new swoole_http_server("0.0.0.0", 8888);

$http->set(
	[
		'enable_static_handler' => true,
		'document_root' => "/home/vagrant/code/think/public/static/home",
		'worker_num' => 4,
	]
);
$http->on('WorkerStart', function ($serv, $worker_id) {
	// 加载基础文件
	require __DIR__ . '/../thinkphp/base.php';
});
$http->on('request', function ($request, $response) {
	if (isset($resquest->server)) {
		foreach ($resquest->server as $k => $v) {
			$_SERVER[strtoupper($k)] = $v;
		}
	}
	$response->end("guanguans" . json_encode($request->get));
});

$http->start();