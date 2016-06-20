<?php

namespace Common\Model\User;
use Base\Model\BaseModel;

/**
 * 权限比对类
 */
class RoleModel extends BaseModel{
	private $role = array(
		'user' =>0,
		'author' =>10,
		'authorAdmin' =>20,
		'admin' =>30,
		'supAdmin' =>100,
	);

	/**
	 * 判断权限是否匹配
	 * @param  string  $currentRole 拥有的权限
	 * @param  string  $role        目标权限
	 * @return boolean
	 */
	public function isRole($currentRole='',$role=''){
		return $currentRole==$role ? true : false;
	}

	/**
	 * 判断权限是否为最高权限
	 * @param  string  $currentRole 拥有的权限
	 * @param  string  $role        目标权限
	 * @return boolean
	 */
	public function isSup($currentRole=''){
		return $this->isRole($currentRole, $this->supRole());
	}

	/**
	 * 最低权限
	 * @param  string $currentRole 拥有的权限
	 * @param  string $role        目标权限
	 * @return boolean
	 */
	public function egtRole($currentRole='',$role=''){
		$result = $this->getEgtRole($role);
		return in_array($currentRole, $result) ? true : false;
	}

	public function getRole($id=0){

	}

	public function getCurrentRole(){

	}

	/**
	 * 获取大于等于某权限的数组
	 * @param  string $role
	 * @return array
	 */
	public function getEgtRole($role=''){
		$role = $this->getRightRole($role);
		$roleLevel = $this->role[$role];
		$result = array_filter($this->role, function($var) use($roleLevel) {
            return $var >= $roleLevel ? true : false;
		});
		return $this->getRoleKeys($result);
	}

	/**
	 * 获取正确的权限或判断权限的正确性
	 * @param  string $role
	 * @return string
	 */
	public function getRightRole($role=''){
		if(in_array($role,$this->getRoleKeys($this->role)))
			return $role;
		return $this->defaultRole();
	}
	/**
	 * 用户权限keys
	 * @param  array  $roleArr [description]
	 * @return [type]          [description]
	 */
	public function getRoleKeys(array $roleArr){
		return array_keys($roleArr);
	}

	/**
	 * 获取默认权限
	 * @return string
	 */
	public function defaultRole(){
		return current($this->getRoleKeys($this->role));
	}

	/**
	 * 获取最高权限
	 * @return string
	 */
	public function supRole(){
		return end($this->getRoleKeys($this->role));
	}
}
