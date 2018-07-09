<?php
/**
 * http_server
 */
$http = new swoole_http_server("0.0.0.0", 8888);

$http->set(
	[
		'enable_static_handler' => true,
		'document_root' => "/home/vagrant/code/think/public/static/home",
	]
);
$http->on('request', function ($request, $response) {
	$response->end("guanguans" . json_encode($request->get));
});

$http->start();