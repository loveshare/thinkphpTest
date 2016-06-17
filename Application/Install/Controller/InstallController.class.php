<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Install\Controller;
use Base\Controller\BaseController;
use Think\Storage;
use Think\Db;
//use Common\Check\Check;
use Common\Model\File\BuildConfig;
use Common\Model\Memory\RedisModel;

class InstallController extends BaseController{

    protected function _initialize(){
        if(Storage::has( 'Conf/install.lock')){
            $this->error(L('installed'));
        }
    }

    public function step($step){
        $func = 'step'.$step;

        $this->$func();
    }

    private function step1(){

        $this->displayi(__FUNCTION__);
    }

    //生成配置文件
    private function step2($db = null, $admin = null){
        $error = array();
        C('DB_TYPE','mysqli');
        $dbhost = I('post.dbhost');
        $dbname = I('post.dbname');
        $uname = I('post.uname');
        $passWord = I('post.passWord');

        //  C('DB_HOST',$dbhost);
        //  C('DB_NAME',$dbname);
        //  C('DB_USER',$uname);
        //  C('DB_PWD',$passWord);

        $DB = array();
        $DB['DB_TYPE'] = 'mysqli';
        $DB['DB_HOST'] = $dbhost;
        $DB['DB_NAME'] = $dbname;
        $DB['DB_USER'] = $uname;
        $DB['DB_PWD'] = $passWord;
        //创建数据库
        $dbname = $DB['DB_NAME'];
        cookie('db_config',$DB);
        unset($DB['DB_NAME']);

        try{
            $sql = "CREATE DATABASE IF NOT EXISTS `{$dbname}` DEFAULT CHARACTER SET utf8";
            //$db  = M(); //直接实例化是不会报出错的
            $db  = Db::getInstance($DB);
            $db->execute($sql); //需要执行一个Sql语句才能调用错误
        }catch(\Exception $e){
            if(strpos($e->getMessage(),'getaddrinfo failed')!==false){
                $error['db'] = '数据库服务器（数据库服务器IP） 填写错误。 很遗憾，创建数据库失败，失败原因';// 提示信息
            }
           if(strpos($e->getMessage(),'Access denied for user')!==false){
               $error['db'] = '数据库用户名或密码 填写错误。 很遗憾，创建数据库失败，失败原因';// 提示信息
           }else{
               $error['db'] = $e->getMessage();// 即使执行建立数据库语句也不会让我们创建数据库 会提示不存在数据的错误 安全机制
           }
        }

        $redisHost = I('post.dbhost');
        C('REDIS_HOST',$redisHost);
		C('REDIS_PORT',6379);
		C('REDIS_TIMEOUT',30);
		C('REDIS_DBNAME',0);
		C('REDIS_CTYPE',1);
        C('REDIS_PWD','');

        try{
            $redis = new RedisModel();
            $redis -> getInstance(0);
            if($redis->ping()){
                $this->assign('redisError','链接 Redis 失败');
            }
        }catch(\Exception $e){
            $redisError = $e->getMessage();
            $error['redis'] = $redisError;
        }

        if(empty($error)){
            $dbSample = ROOT_APP."/Common/Conf/db-sample.php";
            $targetPath = ROOT_APP."/Common/Conf/db.php";
            $List = array(
                'DB_HOST' => $dbhost,
                'DB_NAME' => $dbname,
                'DB_USER' => $uname,
                'DB_PWD' => $passWord,
                'REDIS_HOST' => $redisHost,
            );
            try{
                $configStatus = (new BuildConfig())->setupConfig($dbSample ,$targetPath,$List);
                if(!$configStatus)
                    $error['config'] = '创建配置文件失败';
            }catch(\Exception $e){
                $error['config'] = $e->getMessage();
            }

        }

        $this->assign('error',$error);
        $this->displayi(__FUNCTION__);
    }

    //安装第三步，安装数据表，创建配置文件
    private function step3(){
        $domain = I('post.domain');
        $siteCode = I('post.siteCode');
        $error = array();
echo 111;
        if($domain && $siteCode){
            echo 111;
            //$this->displayi(__FUNCTION__);

                //连接数据库
                $dbconfig = cookie('db_config');
                $db = Db::getInstance($dbconfig);

                //创建数据表
                try{
                    create_tables($db);
                }catch(\Exception $e){
                    $error['db'] = $e->getMessage();
                }

                //注册创始人帐号
                //$auth  = build_auth_key();
                //$admin = session('admin_info');
                //register_administrator($db, $dbconfig['DB_PREFIX'], $admin, $auth);

                //创建配置文件
                //$conf   =   write_config($dbconfig, $auth);
                //session('config_file',$conf);

                echo "<script type=\"text/javascript\">setTimeout(function(){location.href='".U('Index/complete')."'},5000)</script>";
                ob_flush();
                flush();
        }else{
            if(!domain)
                $error['domain'] = $domain;
            if(!siteCode)
                $error['siteCode'] = $siteCode;
            $this->displayi(__FUNCTION__);
        }

    }


}
