<?php
/**
 * 进程信号触发器
 *
 * bool swoole_process::signal(int $signo, callable $callback)    //等待接收信号
 *
 * function swoole_process::alarm(int $interval_usec, int $type = ITIMER_REAL) : bool   //发出信号
 */

#触发函数 异步执行
swoole_process::signal(SIGALRM, function(){
    static $i = 0;
    echo "$i\n";
    $i++;
    if($i>10){
        swoole_process::alarm(-1);   //清除定时器
    }
});

#定时信号
swoole_process::alarm(100 * 1000);