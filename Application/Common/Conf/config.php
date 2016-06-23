<?php

define('__NAME__', '测试工程');
define('__VERSION__', '1.1.1');
define('__WEBSITE__', 'http://www.lawuyou.com');
define('SERVER_NAME', $_SERVER['SERVER_NAME']);
$site = include('site.php');

$conf = array(
	'LOAD_EXT_CONFIG' => 'db,email',
	'OUTPUT_ENCODE' =>  true,
	'COOKIE_PATH' => '/', // Cookie路径
    'COOKIE_PREFIX' => '', // Cookie前缀 避免冲突
	'LANG_SWITCH_ON' => true,
    'LANG_AUTO_DETECT' => false, // 自动侦测语言 开启多语言功能后有效
    'DEFAULT_LANG' => 'zh-cn', // 默认语言
    'LANG_LIST' => 'zh-cn', // 允许切换的语言列表 用逗号分隔
    'VAR_LANGUAGE' => 'l', // 默认语言切换变量
    'PUBLIC_PATH' => '/Public',//静态文件目录
    'URL_MODEL' =>  1, // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式
    'URL_HTML_SUFFIX' =>  '',  // URL伪静态后缀设置
);

return array_merge($conf, $site);
