<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | cms 测试开发
// +----------------------------------------------------------------------
// | Author: 褚兆前 <1028290810@qq.com>
// +----------------------------------------------------------------------
//

// 应用入口文件

if(!defined('ENTRY')){
    require './headerFunction.php';
    define('TMPL_PATH','./Template/');
    define('ENTRY',basename(__FILE__));
}

if (!isset($install) && !is_file( APP_PATH.'/Common/Conf/install.local')) {
    header('Location: /install.php');
    exit;
}


/**
 * 引入核心入口
 */
require './ThinkPHP/ThinkPHP.php';
