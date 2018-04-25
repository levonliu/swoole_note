<?php
/**
 * 服务器
 */
$serv = new swoole_websocket_server("0.0.0.0", 9501);

#open
$serv->on('open', function($serv, $request){
    echo "新用户：".$request->fd."加入\n";
    $GLOBALS[ 'fd' ][ $request->fd ][ 'id' ]   = $request->fd;  //设置用户ID
    $GLOBALS[ 'fd' ][ $request->fd ][ 'name' ] = "匿名用户";  //设置用户名
});

#message
$serv->on('message', function($serv, $request){
    $msg = $GLOBALS[ 'fd' ][ $request->fd ][ 'name' ].":".$request->data."\n";
    if(strstr($request->data, "#name#")) {  //用户设置昵称
        $GLOBALS[ 'fd' ][ $request->fd ][ 'name' ] = str_replace("#name#", '', $request->data);
    } else {  //进行用户信息发送
        foreach($GLOBALS[ 'fd' ] as $i) {
            $serv->push($i[ 'id' ], $msg);
        }
    }
});

#close
$serv->on('close', function($serv, $request){
    echo "客户端：".$request."断开连接\n";
    unset($GLOBALS[ 'fd' ][ $request ]);
});

$serv->start();