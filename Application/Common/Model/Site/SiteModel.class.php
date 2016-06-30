<?php
namespace Common\Model\Site;

use Base\Model\BaseModel;

class SiteModel extends BaseModel{
	protected $tableName = 'site';

	protected $domainV = array(
		array('domain','require','域名必须！'),
		array('domain','url','域名格式不正确！'),
		array('domain',"1,50",'域名长度不能大于50！',0,'length'),
	);
	protected $domainA = array(
		array('domain', 'trim', 3, 'function'),
		array('domain', 'getHost', 3, 'function')
	);

	public function addData(){

	}

	public function selectData(){
		$where['locked'] = array('EQ',0);
		$result = $this->where($where)->select();
		return $result;
	}

	public function installData($data){
		$create = array(
			'siteCode' => $data['siteCode'],
			'siteName' => $data['siteName'],
			'domain' => $data['domain'],
			'email' => $data['email'],
			'adminCenter' => 1,
			'openRole' => 1,
			'status' => 1,
			'industryId' => 'site',
		);
		$data = $this->validate($this->buildInstallV())
					->auto($data)
					->create($create);
		if(!$this->getError())
			return $this->add($data);
		return false;
	}
	private function buildInstallV(){
		return array_merge_recursive(
			$this->siteCodeV,
			$this->email,
			$this->siteName,
			$this->domain,
			$this->industryId
		);
	}
	private function buildInstallA(){
		return $this->domain;
	}
}
