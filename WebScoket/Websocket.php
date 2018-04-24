<?php
/**
 * 创建Websocket服务器
 * new swoole_websocket_server()
 * swoole_websocket_server 继承自swoole_http_server
 * on/start 函数
 * open/message/close
 * push()发送数据
 */

$serv = new swoole_websocket_server("127.0.0.1",9501);

/**
 * on: open 建立连接  $serv:服务器  $request:客户端信息
 *     message 接收信息
 *     close 关闭连接
 */
$serv->on('open',function($serv,$request){
    $serv->push($request->fd,"welcome \n");
});

$serv->on('message',function($serv,$request){
    echo "Message:".$request->data;
    $serv->push($request->fd,"get it message \n");
});

$serv->on('close',function($serv,$request){
    echo "close \n";
});

$serv->start();