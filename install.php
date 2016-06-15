<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | cms 测试开发
// +----------------------------------------------------------------------
// | Author: 褚兆前 <1028290810@qq.com>
// +----------------------------------------------------------------------

// 应用入口文件

define('BIND_MODULE', 'Install');

define('CHANGE_ENTRY',true);
$entry = basename(__FILE__);
//$GLOBALS['entry'] = basename(__FILE__);

if (is_file( APP_PATH.'/Conf/user.php')) {
    header('Location: ./index.php');
    exit;
}

$install = 1;
include('index.php');
