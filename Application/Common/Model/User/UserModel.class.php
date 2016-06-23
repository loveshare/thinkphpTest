<?php
namespace Common\Model\User;

use Base\Model\BaseModel;

class UserModel extends BaseModel{
	protected $tableName = 'user';
	private $addSupUserV = array(
		array('siteCode','require','站点识别码必须！'),
		array('userName','require','用户名必须！'),
		array('passWord','require','密码必须！'),
		array('niceName','require','昵称必须！'),
		array('email','require','邮箱必须！'),
		array('email','email','格式不正确！'),
	);

	private $addSupUserA = array(
		array('siteCode', 'trim', 1,'function'),
		array('userName', 'trim', 1,'function'),
		//array('passWord', 'trim', 'function'),
		array('passWord', 'md5', 1,'function'),
		array('niceName', 'trim', 1,'function'),
		array('email', 'trim', 1,'function'),
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

		$data = $this->validate($this->addSupUserV)
					 ->auto($this->addSupUserA)
					 ->create($creat,1);
		echo $this->getError();
		if(!$this->getError()){
			return $this->add($data);
		}

		return false;
	}

	private function getRoleClass(){
		if(empty($this->role))
			$this->role = $this->newClass('User.Role');
		return $this->role;
	}
}
