<?php
/**
 * 异步写入文件
 *
 * swoole_async_writefile(string $filename, string $fileContent, callable $callback = null, int $flags = 0)
 *
 * 参数1：文件的名称，必须有可写权限
 * 参数2：要写入到文件的内容，最大可写入4M
 * 参数3：写入后的回调函数，可选
 * 参数4：写入的选项，可以使用FILE_APPEND表示追加到文件的末尾
 */
$content = "hello world";
swoole_async_writefile("2.text",$content,function($filename){
    echo $filename;
},0);