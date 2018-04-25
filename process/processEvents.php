<?php
/**
 * 进程事件
 *
 * swoole_event_add()
 * param1: int $sock
 *  int 文件描述
 *  mixed $read_callback 就是 stream_socket_client/fsockopen创建的资源
 *  socket资源，就是sockets扩展中socket_create创建的资源，需要在编译时加入./configure --enable-socket
 *
 * param2: 可读回调函数
 */

#进程池
$workers = [];

#进程数量
$worker_num = 3;

#创建 启动进程
for($i = 0; $i < $worker_num; $i++) {
    $process         = new swoole_process("doProcess");     //创建单独新进程
    $pid             = $process->start();                   //启动进程，并获取进程ID
    $workers[ $pid ] = $process;                      //存入进程池
}

#创建进程执行函数
function doProcess(swoole_process $process)
{
    $process->write("PID:".$process->pid);           //子进程写入信息 pipe
    echo "写入信息：".$process->pid." ".$process->callback."\n";
}

#添加进程事件 向每一个子进程添加需要执行的动作
foreach($workers as $process) {
    swoole_event_add($process->pipe, function($pipe) use ($process){
        $data = $process->read();  //能否读取数据
        echo "接收到：".$data."\n";
    });
}