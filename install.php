<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | cms 测试开发
// +----------------------------------------------------------------------
// | Author: 褚兆前 <1028290810@qq.com>
// +----------------------------------------------------------------------

// 应用入口文件

require './headerFunction.php';

if (is_file( APP_PATH.'/Conf/user.php')) {
    header('Location: ./index.php');
    exit;
}

define('BIND_MODULE', 'Install');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);

// 定义应用目录
define('APP_PATH','./Application/');

//设置模板目录
//define('TMPL_PATH','./Template/');

/**
 * 引入核心入口
 * ThinkPHP亦可移动到WEB以外的目录
 */

require './ThinkPHP/ThinkPHP.php';
