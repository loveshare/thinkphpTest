<?php
$http = new swoole_http_server("127.0.0.1", 9501);

define('DEF','#');
$GLOBALS['GLO'] = '@';
$http->on('request', function ($request, $response) {
    $a = '#';
    $response->end($GLOBALS['GLO'].rand(1000, 9999));
});
$http->start();
