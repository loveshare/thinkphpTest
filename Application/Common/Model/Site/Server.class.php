<?php
namespace Common\Model\Site;

use Base\Model\BaseClass;

class Server extends BaseClass{
	private $logic = null;
	private $siteModel = null;
	private $buildConfig = null;
	private $siteConf = null;

	public function addData($data){
		return $this->getSiteModel()->addData($data);
	}

	public function installData($data){
		return $this->getSiteModel()->installData($data);
	}

	public function selectSite(){
		return $this->getSiteModel()->selectData();
	}

	public function createSiteConfig($data){
		$data = $this->selectSite();
		foreach ($data as $key => $value) {
			$result = $this->getSiteConf()->createSiteConfig($value,$this->getBuildConfig());
			if($this->getError() || !$result)
				return false;
		}
		return ture;
	}

	public function createSiteCodeConfig(){
		$data = $this->selectSite();
		return  $this->getSiteConf()->createSiteCodeConfig($data,$this->getBuildConfig());
	}

	private function getLogic(){
		if($this->$logic)
			return $this->$logic;
		$this->$logic = $this->newClass('Site.Logic');
		return $this->$logic;
	}

	private function getSiteModel(){
		if($this->siteModel)
			return $this->siteModel;
		$this->siteModel = $this->newClass('Site.SiteModel');
		return $this->siteModel;
	}

	private function getBuildConfig(){
		if($this->buildConfig)
			return $this->buildConfig;
        $this->buildConfig = $this->newClass('File.BuildConfig');
		return $this->buildConfig;
    }

	private function getSiteConf(){
		return $this->newClass('Site.SiteConf');
	}
}
