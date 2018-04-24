<?php
/**
 * TCP 客户端
 */

#创建Client对象，连接 127.0.0.1:9501端口
$client = new swoole_client(SWOOLE_SOCK_TCP);

#判断连接是否成功
if (!$client->connect('127.0.0.1', 9501, -1))
{
    exit("connect failed. Error: {$client->errCode}\n");
}

#发送数据接收事件
$client->send("hello world") or die("数据发送失败");

#输出服务返回参数
echo $client->recv();

#连接关闭
$client->close();