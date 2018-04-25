<?php
/**
 * 异步Mysql操作
 *
 * swoole_mysql
 * connect
 * on
 * escape
 * query
 */

#实例化资源
$db = new swoole_mysql();

$config = [
    'host'     => 'mysql',
    'ports'    => '3306',
    'user'     => 'root',
    'password' => 'root',
    'database' => 'mysql',
];

#连接数据库
$db->connect($config, function($db, $r){
    if($r === false) {
        var_dump($db->connect_errno, $db->connect_error);
        die("连接失败");
    }

    #成功
    $sql = "show tables";
    $db->query($sql, function(swoole_mysql $db, $r){
        if($r === false) {
            var_dump($db->error);
            die("操作失败");
        } else if($r === true) {
            var_dump($db->affected_rows, $db->insert_id);
        }
        var_dump($r);
        $db->close();
    });
});