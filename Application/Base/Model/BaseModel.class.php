<?php
namespace Base\Model;

//use Think\Model\AdvModel;
use Think\Model;
use Think\Storage;
use Think\Hook;
use Common\Traits\FunctionTrait;

class BaseModel extends Model {
    use ClassTrait;

    protected $classType = 'Model';
    
    protected $_validatei = array();	//默认自动验证
    protected $_autoi = array();	//默认自动完成
    
    /**
     * 创建数据对象 但不保存到数据库
     * @access public
     * @param mixed $data 创建数据
     * @param string $type 状态
     * @param string $select 选择自动验证 自动完成
     * @return mixed
     */
     public function createi($data='',$type='' ,$selecti='') {
     	if($selecti && !empty($this->$selecti)){

     		if($this->$select['_validate'])
     			$this->_validate = $this->$select['validate'];

     		if($this->$select['_auto'])
     			$this->_auto = $this->$select['_auto'];
     	}else{

     		$this->_validate = $this->_validatei?:$this->_validate;

     		$this->_auto = $this->_autoi?:$this->_auto;
     	}

     	return $this->create($data,$type);
     }

}