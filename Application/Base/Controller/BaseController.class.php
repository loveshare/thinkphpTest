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
     */
    protected $viewi     =  null;

    protected $themei = null;

    protected $classType = 'Controller';

    protected $error = '';
    // protected $status = 'success';
    // protected $message = 'success';

    /**
     * 架构函数 取得模板对象实例
     * @access public
     */
    public function __construct() {
        parent::__construct();
        //实例化视图类
        //$this->message = L('success');

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
    protected function displayi($templateFile='',$charset='',$contentType='',$content='',$prefix=''){

        if(defined('TMPL_PATH')){

            $this->viewi = $this->status;
            $this->viewi = $this->message;

            $this->viewi->displayi($templateFile,$charset,$contentType,$content,$prefix);
        }

        $this->viewi->display($templateFile,$charset,$contentType,$content,$prefix);

     //    $themePath = TMPL_PATH.'config.php';

    	// if(Storage::has($themePath)){
     //        $themeConfig = include($themePath);
     //    }

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
     //    //Hook::listen('view_end');//
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
    protected function assign($name,$value='') {
        $this->viewi->assign($name,$value);
        return $this;
    }

    /**
     * Ajax方式返回数据到客户端
     * @access protected
     * @param string $status 消息类型：info, warning, error, success
     * @param string $message 消息内容
     * @param mixed $data 要返回的数据
     * @param String $type AJAX返回数据格式
     * @param int $json_option 传递给json_encode的option参数
     * @return void
     */
    public function ajaxReturni($status='success', $message='', $data='',$type='',$json_option=0){
        $datai = array();
        $mold = array('info', 'warning', 'error', 'success');
		$status = in_array($status, $mold) ? $status : 'success';
        $datai['status'] = $status;
        $datai['message'] = $message;
        $data = $data?:'';
        $datai['data'] = $data;

        $this->ajaxReturn($data,$type='',$json_option=0);
    }


	/**
	 * 创建消息提示响应
	 * @param  string  $status     消息类型：info, warning, error, success
	 * @param  string  $message  消息内容
	 * @param  string  $title    消息抬头
	 * @param  integer $duration 消息显示持续的时间
	 * @param  string  $goto     消息跳转的页面
	 * @return Response
	 */
	public function createMeseage($status='success', $message='', $title = '',$goto = null) {

		$mold = array('info', 'warning', 'error', 'success');
		$status = in_array($status, $mold) ? $status : 'success';

		$data = array(
			'status'    => $status,
			'message'    => $message,
			'title'    => $title,
			'goto'     => $goto,
		);

		$this->assign($data);
		// $this->status = $status;
        // $this->message = $message;
		//$this->display('./Template/Public/menu.html');
		if($this->classType == 'Controller'){
			return $this->displayi('Home@Default:message');
		}else{
			return E($message);
		}
	}

    /**
     * 返回模型的错误信息
     * @access public
     * @return string
     */
    public function getError(){
        return $this->error;
    }
}
