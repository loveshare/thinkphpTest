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
    public $error = '';
    protected $siteCode;
    protected $checkSiteCode = true;

    protected $siteCodeV = array(
		array('siteCode','require','站点识别码必须！'),
		array("siteCode","1,30","用户名必须在1到30位之间",0,"length"),
		array('siteCode',"/^[0-9a-zA-Z_]+$/",'只能包含数字字母和_！',0,'regex'),
	);
	protected $siteCodeA = array(
		//array('siteCode', 'trim', 3,'function')
	);

	protected $emailV = array(
		array('email','require','邮箱必须！'),
		array('email','email','邮箱格式不正确！'),
		array('email',"1,50",'邮箱长度不能大于50！',0,'length'),
	);
	protected $emailA = array(
		array('email', 'trim', 3,'function'),
	);

    /**
     * 构造函数
     * @access public
     */
    public function __construct() {
        parent::__construct();
        if(C('siteCode') && !C('adminCenter')){
            $this->siteCode = C('siteCode');
            $this->options['where']['siteCode'] = $this->siteCode;
        }
    }

    /**
     * 返回模型的错误信息
     * @access public
     * @return string
     */
    public function &getError(){
        return $this->error;
    }

    public function where($where,$parse=null){
        parent::where($where,$parse=null);
        
        if($this->checkSiteCode && !C('adminCenter') ){
            $this->setSiteCode();
        }
        return $this;
    }

    public function setSiteCode($siteCode=''){
        $this->siteCode = $siteCode ?: $this->siteCode;
        if($this->siteCode)
            $this->options['where']['siteCode'] = $this->siteCode;
        return $this;
    }

    public function closeSiteCode(){
        $this->checkSiteCode = false;
        return $this;
    }

}
