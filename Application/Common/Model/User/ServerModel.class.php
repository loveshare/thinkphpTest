<?php
namespace Common\Model\User;

use Base\Model\BaseClass;

class ServerModel extends BaseClass{

	public function addSupUserData($data){
		return $this->getLogic()->addSupUserData($data);
	}

	private function getLogic(){
		return $this->createService('User.LogicModel');
	}
}
