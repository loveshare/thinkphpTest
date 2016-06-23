<?php
namespace Common\Model\User;

use Base\Model\BaseClass;

class LogicModel extends BaseClass{

	public function addSupUserData($data){
		$result = $this->getUserModel()->addSupUserData($data);
		echo $this->getError();
		return $result;
	}

	private function getUserModel(){
		return $this->createService('User.UserModel');
	}
}
