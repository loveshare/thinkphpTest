<?php
namespace Install\Controller;

use Base\Controller\BaseController;
use Think\Storage;

class IndexController extends BaseController{

    //安装
    public function index(){
       if(is_file( APP_PATH.'/Conf/user.php')){
            $msg = L('install_del_lock');
        }else{
            $msg = L('install_success');
        }
        if(Storage::has('Conf/install.lock')){
            $this->error($msg);
        }
        $this->themeDisplay('default');
    }

    //完成
    public function finish(){
        $step = session('step');

        if(!$step){
            $this->redirect('index');
        } elseif($step != 3) {
            $this->redirect("Install/step{$step}");
        }

        // 写入安装锁定文件
        Storage::put('./Conf/install.lock', 'lock');
        if(!session('update')){
            //创建配置文件
            $this->assign('info',session('config_file'));
        }
        session('step', null);
        session('error', null);
        session('update',null);
        $this->display();
    }
}