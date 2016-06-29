<?php
namespace Common\Model\System;

use Base\Model\BaseModel;

class SystemModel extends BaseModel{
	protected $tableName = 'system';

	protected $systemNameV = array(
		array('systemName','require','站点识别码必须！'),
		array("systemName","1,30","必须在1到30位之间",0,"length")
	);
	protected $systemNameA = array(
		//array('systemName', 'trim', 3,'function')
	);

	public function findData(){
		$result = $this->find();
		return $result;
	}

	public function addData($data){
		$creat= array(
			'systemName' => $data['siteName'],
			'email' => $data['email'],
		);
		$data = false;
		$data = $this->validate($this->buildInstallV())
					 ->auto($this->buildInstallA())
					 ->create($creat,1);
		if(!$this->getError())
			$data =$this->add($data);

		return $data;
	}

	private function buildInstallV(){
		return array_merge_recursive($this->systemNameV, $this->emailV);
	}

	private function buildInstallA(){
		return array_merge_recursive($this->emailV);
	}

}
