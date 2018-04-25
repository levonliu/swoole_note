<?php
/**
 * 异步事件
 *
 * bool swoole_event_add(int $sock, mixd $read_callback, mixed $write_callback = null, int $flags = null)
 */

$fp = stream_socket_client("tcp://www.qq.com:80", $errno, $errstr, 30);

fwrite($fp, "GET / HTTP/1.1\r\nHost:www.qq.com\r\n\r\n");

#添加异步事件
swoole_event_add($fp, function($fp){
    $resp = fread($fp, 8192);
    var_dump($resp);
    swoole_event_del($fp);
    fclose($fp);
});
echo "先执行\n";