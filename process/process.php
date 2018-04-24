<?php
/**
 * 进程创建
 *
 * new swoole_process()
 * param1: mixed $function  子进程创建成功后执行的函数
 * param2: $redirect_stdin_stdout  重定向子进程的标准输入和输出。启用此项后，在进程内echo将不是打印屏幕，而是写入到管道。读取键盘输入将变成从管道中读取。默认为阻塞读取
 *
 * $create_pipe  是否创建管道。 启用
 * $redirect_stdin_stdout后，此选项将忽略用户参数，强制为true，如果子进程内没有进程间通信，可以设置为false
 */

#首先创建进程对应的执行函数
function doProcess(swoole_process $worker)
{
    echo "PID".$worker->pid."\n";
    sleep(10);
}

#创建进程( 3进程 )
$process = new swoole_process("doProcess");
$pid     = $process->start();

$process = new swoole_process("doProcess");
$pid     = $process->start();

$process = new swoole_process("doProcess");
$pid     = $process->start();

#等待结束
swoole_process::wait();