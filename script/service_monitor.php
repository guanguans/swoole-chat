<?php
/**
 * 服务监控 web_socker_server 8888
 */
class Server
{
    const PORT = 8888;

    public function monitor_port()
    {
        $shell = "netstat -anp 2>/dev/null | grep " . self::PORT . " | grep LISTEN | wc -l";

        $result = shell_exec($shell);
        if ($result != 1) {
            // 发送报警服务 邮件 短信
            echo date("Ymd H:i:s") . "-error" . PHP_EOL;
        } else {
            echo date("Ymd H:i:s") . "-succss" . PHP_EOL;
        }
    }
}

swoole_timer_tick(2000, function ($timer_id) {
    (new Server())->monitor_port();
    echo "time-start" . PHP_EOL;
});
