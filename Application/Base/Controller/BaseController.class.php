<?php
namespace Base\Controller;

use Think\Controller;
use Think\Storage;
use Think\Hook;
use Common\Traits\ClassTrait;

class BaseController extends Controller {
    use ClassTrait;

    /**
     * 视图实例对象
     * @var view
     * @access protected
<<<<<<< HEAD
     */
=======
     */    
>>>>>>> e260851edb7f12f970f9f452ac22fc21a3162031
    protected $viewi     =  null;

    protected $themei = null;

    protected $classType = 'Controller';

    protected $error = '';
    protected $status = 'success';
    protected $message = 'success';

    /**
     * 架构函数 取得模板对象实例
     * @access public
     */
    public function __construct() {
        parent::__construct();
        //实例化视图类
<<<<<<< HEAD
=======
        //
        $this->message = L('success');
>>>>>>> e260851edb7f12f970f9f452ac22fc21a3162031

        $this->viewi = new BaseView();
    }

    /**
     * 封装 theme 模板主题和 diplay 模板显示调用内置的抹布安引擎显示方法
     * 增加模板配置文件和
     * @param array $options 自定义数据'customType'=>false,'dataType'=>'json'
     * @param string $theme 模版主题
     * @param string $templateFile 指定要调用的模板文件
     * 默认为空 由系统自动定位模板文件
     * @param string $charset 输出编码
     * @param string $contentType 输出类型
     * @param string $content 输出内容
     * @param string $prefix 模板缓存前缀
     * @return void
     */
<<<<<<< HEAD
    protected function displayi($templateFile='',$charset='',$contentType='',$content='',$prefix=''){

        if(defined('TMPL_PATH')){

            /*
            $this->viewi = $this->status;
            $this->viewi = $this->message;
            */
            $this->viewi->displayi($templateFile,$charset,$contentType,$content,$prefix);
        }

=======
    protected function displayi($options = array(),$templateFile='',$charset='',$contentType='',$content='',$prefix=''){

        if(defined('TMPL_PATH')){

            $this->viewi = $this->status;
            $this->viewi = $this->message;

            $this->viewi->displayi($options ,$templateFile,$charset,$contentType,$content,$prefix);
        }
        
>>>>>>> e260851edb7f12f970f9f452ac22fc21a3162031
        $this->viewi->display($templateFile,$charset,$contentType,$content,$prefix);

     //    $themePath = TMPL_PATH.'config.php';

    	// if(Storage::has($themePath)){
     //        $themeConfig = include($themePath);
     //    }
<<<<<<< HEAD

=======
        
>>>>>>> e260851edb7f12f970f9f452ac22fc21a3162031
    	// //print_r($themeConfig);

    	// // $this->view->theme($theme)->display($templateFile,$charset,$contentType,$content,$prefix);
     //    G('viewStartTime');
     //    // 视图开始标签
     //    Hook::listen('view_begin',$templateFile);
     //    // 解析并获取模板内容
     //    $content = $this->baseFetch($templateFile,$content,$prefix);
     //    // 输出模板内容
     //    //$this->render($content,$charset,$contentType);
     //    // 视图结束标签
<<<<<<< HEAD
     //    //Hook::listen('view_end');//
=======
     //    //Hook::listen('view_end');// 
>>>>>>> e260851edb7f12f970f9f452ac22fc21a3162031
    }

    /**
     * 模板主题设置
     * @access protected
     * @param string $theme 模版主题
     * @return Action
     */
    protected function themei($theme=''){
        if(empty($theme) && empty($this->baseTheme())){
            $theme = 'default';
        }
<<<<<<< HEAD

=======
        
>>>>>>> e260851edb7f12f970f9f452ac22fc21a3162031
        $this->viewi->theme($theme);
        return $this;
    }

    /**
     * 模板变量赋值
     * @access protected
     * @param mixed $name 要显示的模板变量
     * @param mixed $value 变量的值
     * @return Action
     */
    protected function assigni($name,$value='') {
        $this->viewi->assign($name,$value);
        return $this;
    }

    public function ajaxReturni($data,$type='',$json_option=0){
        $this->ajaxReturn($data,$type='',$json_option=0);
    }



<<<<<<< HEAD
}
=======
}
>>>>>>> e260851edb7f12f970f9f452ac22fc21a3162031
