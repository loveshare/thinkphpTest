<?php
namespace Base\Model;

use Common\Traits\ClassTrait;

class BaseClass{
	use ClassTrait;

	public $classType = 'Class';
	protected $parameter;
    public $error = '';
	protected $instance;

	/**
     * 返回模型的错误信息
     * @access public
     * @return string
     */
    public function &getError(){
        return $this->error;
    }
}
