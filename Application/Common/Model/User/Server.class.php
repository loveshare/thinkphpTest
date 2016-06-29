<?php
namespace Common\Model\User;

use Base\Model\BaseClass;

class Server extends BaseClass{

	public function addSupUserData($data){
		return $this->getUserModel()->addSupUserData($data);
	}

	private function getLogic(){
		return $this->newClass('User.Logic');
	}

	private function getUserModel(){
		return $this->newClass('User.UserModel');
	}
}
