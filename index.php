<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | cms 测试开发
// +----------------------------------------------------------------------
// | Author: 褚兆前 <1028290810@qq.com>
// +----------------------------------------------------------------------
//
/**
 * @modify
 * @author chuzhaoqian
 *
 * view.class.php #@modify# private function getTemplateTheme() -> protected function getTemplateTheme()
 *
 * Model.class.php select find union where save add addAll count
 * 	# public function __construct 设置默认siteCode 管理中心忽略siteCode 和 model忽略siteCode设置
 * 	#protected $error   #@modify#   public $error
 *
 * Template.class.php 多次继承问题
 *  # protected function parseExtend #@add# $content = $this->parseExtend($content);
 *  # private function replaceBlock($content)	#@modify# $content = $content[3]; -> $content = $content[0];
 */

// 应用入口文件

require './headerFunction.php';

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);

// 定义应用目录
$app = 'Application';
define('APP_PATH','./'.$app.'/');

define('_TMPL_PATH','./Template/');

if (!isset($install) && !is_file( APP_PATH.'/Conf/user.php')) {
    header('Location: /install.php');
    exit;
}
//设置模板目录
if(!defined('CHANGE_ENTRY')){
	define('TMPL_PATH',_TMPL_PATH);
}
$entry = $entry?:basename(__FILE__);
define('ENTRY',$entry);

//$GLOBALS['rootPath'] = dirname(__FILE__);
define('ROOT_PATH',dirname(__FILE__));

//$GLOBALS['rootApp'] = dirname(__FILE__).'/'.$app;
define('ROOT_APP',ROOT_PATH.'/'.$app);

/**
 * 引入核心入口
 */
require './ThinkPHP/ThinkPHP.php';
