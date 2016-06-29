<?php
namespace Common\Model\User;

use Base\Model\BaseModel;

class UserModel extends BaseModel{
	protected $tableName = 'user';

	protected $_validate = array();

	private $userNameV = array(
		array('userName','require','必须！'),
		array('userName',"1,30",'userName长度不能大于30！',0,'length'),
		array('userName',"/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9a-zA-Z_]+$/",'userName只能包含数字字母和_且必须包含数字和字母！',0,'regex'),
	);
	private $userNameA = array(
		//array('userName', 'trim', 3,'function')
	);

	private $passWordV = array(
		array('userName','require','必须！'),
		array('userName',"1,30",'userName长度不能大于30！',0,'length'),
	);
	private $passWordA = array(
		array('passWord', 'trim', 3,'function'),
		array('passWord', 'userMd5', 3,'function')
	);

	private $niceNameV = array(
		array('niceName','require','必须！'),
		array('niceName',"1,30",'niceName长度不能大于30！',0,'length'),
		array('niceName',"/^[0-9a-zA-Z_]+$/",'只能包含数字字母和_！',0,'regex'),
	);
	private $niceNameA = array(
		//array('niceName', 'trim', 3,'function'),
	);

	private $regdateA = array(
		array('regdate', 'time', 3,'function'),
	);

	private $role;
	public function addSupUserData($data){
		$creat = array(
			'siteCode' => $data['siteCode'],
			'userName' => $data['uname'],
			'passWord' => $data['passWord'],
			'niceName' => $data['uname'],
			'email' => $data['email'],
			'status' => 1,
			'role' => $this->getRoleClass()->supRole(),
		);

		$data = $this->validate($this->buildAddSupV())
					 ->auto($this->buildAddSupA())
					 ->create($creat,1);
		if(!$this->getError()){
			return $this->add($data);
		}

		return false;
	}

	private function buildAddSupV(){
		return array_merge_recursive(
			$this->siteCodeV,
			$this->userNameV,
			$this->passWordV,
			$this->niceNameV,
			$this->emailV
		);
	}

	private function buildAddSupA(){
		return array_merge_recursive(
			$this->siteCodeA,
			$this->userNameA,
			$this->passWordA,
			$this->niceNameA,
			$this->emailA,
			$this->regdateA
		);
	}

	private function getRoleClass(){
		return $this->newClass('User.Role');
	}
}
