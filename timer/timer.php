<?php
/**
 * 定时器
 *
 * 循环触发
 * swoole_timer_tick
 * param1：int $after_time_ms 指定时间[毫秒]
 * param2：mixed $callback_function 执行的函数
 * 清除定时器：
 *      bool swoole_timer_clear(int $timer_id)
 *
 *
 * 单次触发
 * swoole_timer_after
 * param1：int $after_time_ms 指定时间[毫秒]
 * param2：mixed $callback_function 执行的函数
 * param3: mixed $user_param 用户参数
 */

#循环执行定时器
swoole_timer_tick(2000,function($timer_id){
    echo "执行 $timer_id \n";
});

#单次执行
swoole_timer_after(3000,function(){
    echo "单次执行 \n";
});