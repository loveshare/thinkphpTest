<?php
namespace Common\Traits;

Trait ClassTrait {

	/**
	 * 实例化 common 下的模
	 * @param  string $name 模块目录.模块
	 * @return object       模块实例化的对象
	 */
	public function createService($name)
	{
	    list($module, $className) = explode('.', $name);
	    $class = '\\Common\\Model\\' . $module . '\\' . $className;

	    $obj = new $class();

	    $this->error = &$obj->getError();
	    return $obj;
	}

	/**
	 * 实例化 common 下的模 无错误引用
	 * @param  string $name 模块目录.模块
	 * @return object       模块实例化的对象
	 */
	public function newClass($name)
	{
	    list($module, $className) = explode('.', $name);
	    $class = '\\Common\\Model\\' . $module . '\\' . $className;

	    $obj = new $class();
	    return $obj;
	}
}
