<?php

header("Content-Type:text/html;charset=utf-8");

 //只显示重要错误
error_reporting(E_ERROR);

if (version_compare(PHP_VERSION, '5.3.0', '<'))
    die('当前PHP版本' . PHP_VERSION . '，最低要求PHP版本5.3.0 <br/><br/>很遗憾，未能达到最低要求。本系统必须运行在PHP5.3 及以上版本。如果您是虚拟主机，请联系空间商升级PHP版本，如果您是VPS用户，请自行升级php版本或者联系VPS提供商寻求技术支持。');

function reset_session_path()
{
    $root = str_replace("\\", '/', dirname(__FILE__));
    $savePath = $root . "/tmp/";
    if (!file_exists($savePath))
        @mkdir($savePath, 0777);
    session_save_path($savePath);
}

//reset_session_path();  //如果您的服务器无法安装或者无法登陆，又或者后台验证码无限错误，请尝试取消本行起始两条左斜杠，让本行代码生效，以修改session存储的路径


/*移除magic_quotes_gpc参数影响*/ 
if (get_magic_quotes_gpc()) {
    function stripslashes_deep($value)
    {
        $value = is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
        return $value;
    }

    $_POST = array_map('stripslashes_deep', $_POST);
    $_GET = array_map('stripslashes_deep', $_GET);
    $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
    $_REQUEST = array_map('stripslashes_deep', $_REQUEST);
}
/*移除magic_quotes_gpc参数影响end*/