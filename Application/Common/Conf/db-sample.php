<?php
    //项目配置文件
    return array(
        //数据库配置信息
        'DB_TYPE'   => 'mysqli', // MYSQL数据库类型
        'DB_HOST'   => 'DBHOST', // MYSQL服务器地址
        'DB_NAME'   => 'DBNAME', // MYSQL数据库名
        'DB_USER'   => 'DBUSER', // MYSQL用户名
        'DB_PWD'    => 'DBPWD', // MYSQL密码
        'DB_PORT'   => 3306, // MYSQL端口
        'DB_PREFIX' => '', // MYSQL数据库表前缀

        'REDIS_HOST' => '', //REDIS服务主机IP
        'REDIS_PORT' => '', //REDIS服务端口
        'REDIS_TIMEOUT' => '', //REDIS连接时长 默认为0 不限制时长
        'REDIS_DBNAME' => '', //REDIS数据库名
        'REDIS_CTYPE' => '', //REDIS连接类型 1普通连接 2长连接
        'REDIS_PWD' => '', //REDIS密码
    );
