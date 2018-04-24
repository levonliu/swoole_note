<?php
/**
 * 创建TCP服务器
 * 实例化swoole服务器
 * new swoole_server(string $host, int $port, int $mode = SWOOLE_PROCESS, int $sock_type = SWOOLE_SOCK_TCP);
 * $host:127.0.0.1 监听本地IP
 *       192.168.5.158 监听外网IP
 *       0.0.0.0  监听多个端口
 *       监听规则：ipv4 ipv6
 * $port:端口
 *        1024一下 需要root权限
 * $model:SWOOLE_PROCESS 多进程方式
 * $sock_type:SWOOLE_SOCK_TCP
 *
 *
 * bool swoole_server->on(string $evnet, mixed $callback);
 *
 * 开启TCP服务器
 * bool swoole_server->start();
 *
 * bool swoole_server->send(int $fd, string $data, int $reactorThreadId = 0);
 *
 * function swoole_server->set(array $setting);
 *
 */

$host = '127.0.0.1';
$port = '9501';

$serv = new swoole_server($host, $port);


/**
 * 使用 => bool $swoole_server->on(string $event, mixed $callback)
 *
 * $even: connect:当建立连接时候 $serv:服务器信息 $fd:客户端信息
 *        receive:当接收到数据   $serv:服务器信息 $fd:客户端信息 $from_id:客户端ID $data:数据
 *        close: 关闭连接
 */

$serv->on('connect', function($serv, $fd){
    echo "建立连接\n";
});

$serv->on('receive', function($serv, $fd,$from_id, $data){
    echo "接收到数据\n";
    var_dump($data);
});

$serv->on('close', function($serv, $fd){
    echo "关闭连接\n";
});

#启动服务
$serv->start();