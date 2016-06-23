<?php
namespace Base\Model;

use Common\Traits\ClassTrait;

class BaseClass{
	use ClassTrait;

	protected $classType = 'Class';
    public $error = '';

	/**
     * 返回模型的错误信息
     * @access public
     * @return string
     */
    public function &getError(){
        return $this->error;
    }
}
