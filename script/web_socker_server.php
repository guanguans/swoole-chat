<?php
/**
 * webSocker_server
 */
class WebSocket
{
    const HOST = "0.0.0.0";

    const PORT = 8888;

    const CHAT_PORT = 8889;

    protected $webSocket;

    public function __construct()
    {
        $this->webSocket = new swoole_websocket_server(self::HOST, self::PORT);
        $this->webSocket->listen(self::HOST, self::CHAT_PORT, SWOOLE_SOCK_TCP);
        $this->webSocket->set(
            [
                'enable_static_handler' => true,
                'document_root'         => "/home/vagrant/code/think/public",
                'worker_num'            => 3,
                'task_worker_num'       => 4,
            ]
        );

        $this->webSocket->on("start", [$this, 'onStart']);
        $this->webSocket->on("open", [$this, 'onOpen']);
        $this->webSocket->on("message", [$this, 'onMessage']);
        $this->webSocket->on("workerstart", [$this, 'onWorkerStart']);
        $this->webSocket->on("request", [$this, 'onRequest']);
        $this->webSocket->on("task", [$this, 'onTask']);
        $this->webSocket->on("finish", [$this, 'onFinish']);
        $this->webSocket->on("close", [$this, 'onClose']);

        $this->webSocket->start();
    }

    /**
     * @param $server
     */
    public function onStart($server)
    {
        // swoole_set_process_name("live_master");
    }

    /**
     * 监听 webSocker_server 连接事件
     * @param $ws
     * @param $request
     */
    public function onOpen($ws, $request)
    {
        // 将客户端 fd 存入 redis 有序集合中
        \guanguans\Redis::getInstance()->zadd($request->fd);
        echo "链接用户ID：{$request->fd}\n";
    }

    /**
     * 监听 webSocker_server 消息事件
     * @param $ws
     * @param $client
     */
    public function onMessage($ws, $client)
    {
        echo "client-id:{$client->fd}\n";
        echo "client-data:{$client->data}\n";
        $ws->push($client->fd, "server-push-data:$client->fd--{$client->data}" . date('Y-m-d H:i:s'));
    }

    /**
     * @param $server
     * @param $worker_id
     */
    public function onWorkerStart($server, $worker_id)
    {
        // 加载基础文件
        // require __DIR__ . '/../thinkphp/base.php';
        require __DIR__ . '/../public/index.php';
    }

    /**
     * request回调
     * @param $request
     * @param $response
     */
    public function onRequest($request, $response)
    {
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

        $_POST['http_object_server'] = $this->webSocket;

        ob_start();
        try {
            // 执行应用并响应
            \think\Container::get('app')->run()->send();
        } catch (\Exception $e) {
            print_r($e->getMessage());
        }
        // echo "--action--" . request()->action() . PHP_EOL;
        $res = ob_get_contents();
        ob_end_clean();
        $response->end($res);
        // $webSocket->close($request->fd);
    }

    /**
     * @param $serv
     * @param $taskId
     * @param $workerId
     * @param $data
     */
    public function onTask($serv, $taskId, $workerId, $data)
    {
        $task   = new \app\common\service\TaskService();
        $method = $data['method'];
        // 执行对应方法
        $res = $task->$method($data['data'], $serv);
        print_r($res);
    }

    /**
     * @param $serv
     * @param $taskId
     * @param $data
     */
    public function onFinish($serv, $taskId, $data)
    {
        echo "taskId-finish:{$taskId}\n";
        echo "finish-data-sucess:{$data}\n";
    }

    /**
     * close
     * @param $webSocket
     * @param $fd
     */
    public function onClose($webSocket, $fd)
    {
        // 将客户端 fd 从 redis 有序集合中删除
        \guanguans\Redis::getInstance()->zrem($fd);
        echo "clientid-close:{$fd}\n";
    }
}

new WebSocket();
