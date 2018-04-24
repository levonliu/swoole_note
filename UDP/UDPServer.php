<?php
/**
 * 创建UDP服务器
 * new swoole_server();
 *
 * 关键点：$sock_type = SWOOLE_SOCK_UDP
 *
 * function onPacket(swoole_server $server, string $data, array $client_info);
 *
 * bool swoole_server->sendto(string $ip, int $port, string $data, int $server_socket = -1)
 */

$serv = new swoole_server("127.0.0.1", '9502', SWOOLE_PROCESS, SWOOLE_UDP);

/**
 * 监听数据接收的事件
 *
 * $serv:服务器信息
 * $data:接收到的数据
 * $fd:客户端信息
 */
$serv->on('packet',function($serv,$data,$fd){
    //发送数据到相应客户端，反馈信息
    $serv->sendto($fd['address'],$fd['port'],"Server: $data");
});

#启动服务
$serv->start();
