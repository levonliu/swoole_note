<?php
/**
 * DNS查询
 *
 * swoole_async_dns_lookup("域名地址",function($host,$ip){})
 */

#执行DNS查询
swoole_async_dns_lookup("www.baidu.com",function($host,$ip){
    echo "$host---$ip";
});