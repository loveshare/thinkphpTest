<?php

namespace Common\Model\System;

use Base\Model\BaseClass;

class SystemConf extends BaseClass{

	public function createConfig(array $list, $buildConfig=null){
		$systemPath = APP_PATH."/Common/Conf/system.php";
		$result = false;

		try{
			$result = $buildConfig->createConfig($systemPath, '', $list);
		}catch(\Exception $e){
			$this->error = $e->getMessage();
		}
		return $result;
	}

}
