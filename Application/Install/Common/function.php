<?php
/**
 * 创建数据表
 * @param  resource $db 数据库连接资源
 */
function createTables($db)
{
    //读取SQL文件
    $sql = file_get_contents(MODULE_PATH . 'Data/install.sql');
    $sql = str_replace("\r", "\n", $sql);
    $sql = explode(";\n", $sql);

    foreach ($sql as $value) {
        $value = trim($value);
        if (empty($value)) continue;
        $db->execute($value);
    }
}
