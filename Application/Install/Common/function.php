<?php


/**
 * 创建数据表
 * @param  resource $db 数据库连接资源
 */
function create_tables($db, $prefix = '')
{
    //读取SQL文件
    $sql = file_get_contents(MODULE_PATH . 'Data/install.sql');
    $sql = str_replace("\r", "\n", $sql);
    $sql = explode(";\n", $sql);

    //开始安装
    show_msg('开始安装数据库...');
    foreach ($sql as $value) {
        $value = trim($value);
        if (empty($value)) continue;
        if (substr($value, 0, 12) == 'CREATE TABLE') {
            $name = preg_replace("/^CREATE TABLE IF NOT EXISTS `(\w+)` .*/s", "\\1", $value);
            $msg = "创建数据表{$name}";
            if (false !== $db->execute($value)) {
                show_msg($msg . '...成功');
            } else {
                show_msg($msg . '...失败！', 'error');
                session('error', true);
            }
        } else {
            $db->execute($value);
        }
    }
}

function register_administrator($db, $prefix, $admin, $auth)
{
    show_msg('开始注册创始人帐号...');
    $uid = 1;
    /*插入用户*/
    $sql = <<<sql
REPLACE INTO `[PREFIX]ucenter_member` (`id`, `username`, `password`, `email`, `mobile`, `reg_time`, `reg_ip`, `last_login_time`, `last_login_ip`, `update_time`, `status`, `type`) VALUES
('[UID]', '[NAME]', '[PASS]','[EMAIL]', '', '[TIME]', '[IP]', '[TIME]', '[IP]',  '[TIME]', 1, 1);
sql;

    $password = user_md5($admin['password'], $auth);
    $sql = str_replace(
        array('[PREFIX]', '[NAME]', '[PASS]', '[EMAIL]', '[TIME]', '[IP]', '[UID]'),
        array($prefix, $admin['username'], $password, $admin['email'], NOW_TIME, get_client_ip(1), $uid),
        $sql);
    //执行sql
    $db->execute($sql);

    /*插入用户资料*/
    $sql = <<<sql
REPLACE INTO `[PREFIX]member` (`uid`, `nickname`, `sex`, `birthday`, `qq`, `login`, `reg_ip`, `reg_time`, `last_login_ip`, `last_login_role`, `show_role`, `last_login_time`, `status`, `signature`) VALUES
('[UID]','[NAME]', 0,  '0', '', 1, 0, '[TIME]', 0, 1, 1, '[TIME]', 1, '');
sql;

    $sql = str_replace(
        array('[PREFIX]', '[NAME]', '[TIME]', '[UID]'),
        array($prefix, $admin['username'], NOW_TIME, $uid),
        $sql);


    $db->execute($sql);

    /*初始化角色表*/
    $sql = <<<sql
REPLACE INTO `[PREFIX]role` (`id`, `group_id`, `name`, `title`, `description`, `user_groups`, `invite`, `audit`, `sort`, `status`, `create_time`, `update_time`) VALUES
    (1, 0, 'default', '普通用户', '普通用户', '1', 0, 0, 0, 1, [TIME], [TIME]);
sql;
    $sql = str_replace(
        array('[PREFIX]', '[TIME]', '[UID]'),
        array($prefix, NOW_TIME, $uid),
        $sql);
    $db->execute($sql);

    /*插入角色和用户对应关系*/
    $sql = <<<sql
REPLACE INTO `[PREFIX]user_role` (`id`, `uid`, `role_id`, `status`, `step`, `init`) VALUES
    (1, [UID], 1, 1, 'finish', 1);
sql;
    $sql = str_replace(
        array('[PREFIX]', '[UID]'),
        array($prefix, $uid),
        $sql);
    $db->execute($sql);

    /*初始化用户角色end*/

    show_msg('创始人帐号注册完成！');
}
