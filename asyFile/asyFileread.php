<?php
/**
 * 异步读取文件
 *
 * swoole_async_readfile(string $filename, mixed $callback)
 *
 * swoole\Async::readFile(string $filename, mixed $callback)
 */

swoole_async_readfile(__DIR__."/1.text",function($filename,$content){
    echo $filename."----".$content;
});