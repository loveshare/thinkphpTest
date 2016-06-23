<?php
namespace Base\Model;

//use Think\Model\AdvModel;
use Think\Model;
//use Think\Storage;
//use Think\Hook;
use Common\Traits\ClassTrait;

class BaseModel extends Model {
    use ClassTrait;

    protected $classType = 'Model';

    /**
     * 返回模型的错误信息
     * @access public
     * @return string
     */
    public function &getError(){
        return $this->error;
    }

}
