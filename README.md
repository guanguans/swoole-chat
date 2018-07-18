# 基于 ThinkPHP5 和 Swoole 开发的聊天室



## 安装

### 安装 Swoole 扩展

``` bash
pecl install swoole
```

### 安装 Redis 扩展

``` bash
pecl install Redis
```

### 克隆本项目

``` bash
git clone https://github.com/guanguans/swoole-live.git
cd swoole-live
composer install
```
## 使用

### 修改 thinkphp/library/think/Request.php 中 pathinfo 和 path 方法

``` php
<?php
public function pathinfo()
{
    // if (is_null($this->pathinfo)) {
    if (isset($_GET[$this->config['var_pathinfo']])) {
        // 判断URL里面是否有兼容模式参数
        $pathinfo = $_GET[$this->config['var_pathinfo']];
        unset($_GET[$this->config['var_pathinfo']]);
    } elseif ($this->isCli()) {
        // CLI模式下 index.php module/controller/action/params/...
        $pathinfo = isset($_SERVER['argv'][1]) ? $_SERVER['argv'][1] : '';
    } elseif ('cli-server' == PHP_SAPI) {
        $pathinfo = strpos($this->server('REQUEST_URI'), '?') ? strstr($this->server('REQUEST_URI'), '?', true) : $this->server('REQUEST_URI');
    } elseif ($this->server('PATH_INFO')) {
        $pathinfo = $this->server('PATH_INFO');
    }

    // 分析PATHINFO信息
    if (!isset($pathinfo)) {
        foreach ($this->config['pathinfo_fetch'] as $type) {
            if ($this->server($type)) {
                $pathinfo = (0 === strpos($this->server($type), $this->server('SCRIPT_NAME'))) ?
                substr($this->server($type), strlen($this->server('SCRIPT_NAME'))) : $this->server($type);
                break;
            }
        }
    }

    $this->pathinfo = empty($pathinfo) || '/' == $pathinfo ? '' : ltrim($pathinfo, '/');
    // }

    return $this->pathinfo;
}

public function path()
{
    // if (is_null($this->path)) {
    $suffix   = $this->config['url_html_suffix'];
    $pathinfo = $this->pathinfo();

    if (false === $suffix) {
        // 禁止伪静态访问
        $this->path = $pathinfo;
    } elseif ($suffix) {
        // 去除正常的URL后缀
        $this->path = preg_replace('/\.(' . ltrim($suffix, '.') . ')$/i', '', $pathinfo);
    } else {
        // 允许任何后缀访问
        $this->path = preg_replace('/\.' . $this->ext() . '$/i', '', $pathinfo);
    }
    // }

    return $this->path;
}
```

### public/static/home/js/app.js 中配置 

``` js
/**
 * 系统配置
 */
var app = {
    // 本地 IP 地址
    host:'http://192.168.10.10:8888',
};
```

### 启动服务

``` bash
php script/web_socker_server.php
```

### 平滑重启

``` bash
sh script/restart_service.sh
```

### 浏览器中查看

```
http://192.168.10.10:8888/static/home/detail.html
```

## License

[Apache License 2.0](./LICENSE)