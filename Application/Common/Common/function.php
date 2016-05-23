<?php

/**
 * [实例化 common 下的模]
 * @param  [string] $name [模块目录.模块]
 * @return [object]       [模块实例化的对象]
 */
function createModel($name)
{
	static $obj = array();

	if(!empty($obj[$name])){
		return $obj[$name];
	}

	$modelName[] = $name;

    list($module, $className) = explode('.', $name);
    $class = '\\Common\\Model\\' . $module . '\\' . $className;

    if (!class_exists($class))
        $class .= "Model";

    $obj[$name] = new $class();

    return $obj[$name];
}