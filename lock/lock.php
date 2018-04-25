<?php
/**
 * 锁机制
 *
 * $lock = new swoole_lock(SWOOLE_MUTEX)
 * lock()    //锁
 * unlock()  //解锁
 *
 * 文件锁/读写锁/信号量/互斥锁/自旋锁
 */

#创建锁对象
$lock = new swoole_lock(SWOOLE_MUTEX);  //互斥锁

echo "创建互斥锁\n";

$lock->lock();  //开始锁定 主进程
if(pcntl_fork() > 0) {
    sleep(1);

    //解锁
    $lock->unlock();
} else {
    echo "子进程 等待锁\n";

    //上锁
    $lock->lock();
    echo "子进程 获取锁\n";

    //释放锁
    $lock->unlock();
    exit("子进程推出\n");
}

echo "主进程 释放锁\n";
unset($lock);
sleep(1);
echo "子进程退出\n";