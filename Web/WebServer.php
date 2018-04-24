<?php
/**
 * 创建web服务器
 *
 * new swoole_http_server();
 *
 * swoole_http_server 继承来自 swoole_server
 *
 * 参数1：string $host 监听IP地址
 * 参数2：int $port    监听的端口
 * on/start 函数
 */

$serv = new swoole_http_server('127.0.0.1', 9501);

/**
 * 获取请求
 * $request:请求信息
 * $response:返回信息
 */
$serv->on('request', function($request, $response){
    $response->header("Content-Type","text/html;charset=utf-8");      //设置请求头信息
    $response->end("hello world".rand(100,999));                      //发送信息
});

$serv->start();