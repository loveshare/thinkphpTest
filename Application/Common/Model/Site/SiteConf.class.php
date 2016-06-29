<?php

namespace Common\Model\Site;

use Base\Model\BaseClass;

class SiteConf extends BaseClass{

	public function createSiteConfig(array $list, $buildConfig=null){
		$systemPath = ROOT_APP."/Common/Conf/SiteConfig/{$list['siteCode']}.php";
		$result = false;

		try{
			$result = $buildConfig->createConfig($systemPath, '', $list);
		}catch(\Exception $e){
			$this->error = $e->getMessage();
		}
		return $result;
	}

	public function createSiteCodeConfig(array $list, $buildConfig=null){
		$systemPath = ROOT_APP."/Common/Conf/siteCode.php";
		$result = false;

		try{
			$result = $buildConfig->createConfig($systemPath, 'siteCode', $list);
		}catch(\Exception $e){
			$this->error = $e->getMessage();
		}
		return $result;
	}

}
