<?php
/**
 * 进程队列通信
 *
 * string swoole_process->pop(int $maxsize = 8192);
 *
 * bool swoole_process->push(string $data);
 *
 * array swoole_process::wait(bool $blocking = true)
 */

$workers    = [];  //进程池
$worker_num = 2;   //最大进程数

#批量创建进程
for($i = 0; $i < $worker_num; $i++) {
    #创建子进程
    $process = new swoole_process('doProcess', false, false);   //第三个参数为false 才能通信

    #开启队列
    $process->useQueue();

    $pid = $process->start();

    $workers[ $pid ] = $process;
}

function doProcess(swoole_process $process)
{
    $recv = $process->pop();
    echo "从主进程获取到的数据：".$recv."\n";
    sleep(5);
    $process->exit(0);
}

#主进程向子进程添加数据
foreach($workers as $pid => $process) {
    $process->push('hello '.$pid."\n");
}

#等待子进程结束 回收资源
for($i = 0; $i < $worker_num; $i++) {
    $ret = swoole_process::wait();
    $pid = $ret[ 'pid' ];
    unset($workers[ $pid ]);
    echo "子进程退出,$pid \n";
}