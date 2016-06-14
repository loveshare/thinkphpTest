<?php
namespace Common\Traits;

Trait ClassTrait {

	/**
	 * [实例化 common 下的模]
	 * @param  [string] $name [模块目录.模块]
	 * @return [object]       [模块实例化的对象]
	 */
	public function createService($name)
	{

	    list($module, $className) = explode('.', $name);
	    $class = '\\Common\\Model\\' . $module . '\\' . $className;

	    $obj = new $class();

	    $this->error = &$obj->error;

	    return $obj;
	}

	/**
	 * 创建消息提示响应
	 * @param  string  $type     消息类型：info, warning, error, success
	 * @param  string  $message  消息内容
	 * @param  string  $title    消息抬头
	 * @param  integer $duration 消息显示持续的时间
	 * @param  string  $goto     消息跳转的页面
	 * @return Response
	 */
	public function createMeseage($status='success', $message, $title = '',$goto = null) {

		$mold = array('info', 'warning', 'error', 'success');
		$status = in_array($status, $mold) ? $status : 'success';

		$data = array(
			'title'    => $title,
			'goto'     => $goto,
		);

		$this->assign($data);
		$this->assign($status);
		$this->assign($message);

		//$this->display('./Template/Public/menu.html');
		if($this->classType == 'Controller'){
			return $this->displayi('Home@Default:message');
		}else{
			return E($message);
		}
	}

	/**
     * Ajax方式返回数据到客户端
     * @access protected
	 * @param  string  $type     消息类型：info, warning, error, success
	 * @param  string  $message  消息内容
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
		$datai['data'] = $data;

		$this->ajaxReturn($datai,$type,$json_option=0);
	}

}
