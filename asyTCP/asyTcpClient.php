<?php
/**
 * 异步TCP客户端
 *
 * new swoole_client(SWOOLE_SOCK_TCP,SWOOLE_SOCK_ASYNC)
 * SWOOLE_SOCK_TCP      TCP协议
 * SWOOLE_SOCK_ASYNC    异步支持
 */

#创建异步TCP客户端
$client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);

#注册连接成功的回调
$client->on('connect', function($cli){
    $cli->send("hello \n");
});

#注册数据接收 $cli:服务端信息 $data 数据
$client->on('receive', function($cli, $data){
    echo "data".$data;
});

#注册失败
$client->on("error", function($cli){
    echo "失败\n";
});

#注册关闭函数
$client->on('close', function($cli){
    echo "关闭\n";
});

#发起连接
$client->connect("127.0.0.1", 9501, 10);