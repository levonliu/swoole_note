<?php
/**
 * 异步TCP服务器
 *
 * task()函数 投递异步任务
 * on('事件',function(){})处理函数  执行异步函数
 * finish()函数  任务处理完成后结果
 */

#创建TCP服务器
$serv = new swoole_server("0.0.0.0", 9501);

#设置异步 进程工作数
$serv->set(array( 'task_worker_num' => 4 ));

#投递异步任务
$serv->on('receive',function($serv,$fd,$from_id,$data){
    $task_id = $serv->task($data);  //获取异步ID
    echo "异步ID：".$task_id."\n";
});

#处理异步任务
$serv->on('task',function($serv,$task_id,$from_id,$data){
    echo "执行异步ID:".$task_id."\n";
    $serv->finish($data."->OK");
});

#处理结果
$serv->on('finish',function($serv,$task_id,$data){
    echo "执行完成";
});

#启动服务
$serv->start();