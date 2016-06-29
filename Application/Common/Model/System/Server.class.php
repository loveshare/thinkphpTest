<?php
namespace Common\Model\System;

use Base\Model\BaseClass;

class Server extends BaseClass{

	public function addData($data){
		return $this->getSystemModel()->addData($data);
	}

	public function createConfig(){
		$data = $this->getSystemModel()->findData();
		return $this->getSystemConf()->createConfig($data, $this->getBuildConfig());
	}

	private function getLogic(){
		return $this->newClass('System.Logic');
	}

	private function getSystemModel(){
		return $this->newClass('System.SystemModel');
	}

	private function getBuildConfig(){
        return $this->newClass('File.BuildConfig');
    }

	private function getSystemConf(){
		return $this->newClass('System.SystemConf');
	}
}
