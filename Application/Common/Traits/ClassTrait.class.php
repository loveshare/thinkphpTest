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
	public function createMeseage($status='success', $message, $title = '', $duration = 0, $goto = null) {

		$mold = array('info', 'warning', 'error', 'success');
		$type = in_array($type, $mold) ? $type : 'success';

		$data = array(
			'title'    => $title,
			'duration' => $duration,
			'goto'     => $goto,
		);

		$this->assign($data);
		$this->status = $status;
        $this->message = $message;
		//$this->display('./Template/Public/menu.html');
		if($this->classType == 'Controller'){
			return $this->displayi(array('customType'=>true,'dataType'=>'json'),'Home@Default:message');
		}else{
			return E($message);
		}
	}

}