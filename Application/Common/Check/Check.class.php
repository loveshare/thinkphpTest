<?php
namespace Common\Check;

class Check{
	
	// protected $useMysqli;

	// public function __construct(){
	// 	$this->setUseMysqli();
	// }

	/**
	 * 系统环境检测
	 * @return array 系统环境数据
	 */
	function checkEnv()
	{
		$items = array(
			'os' => array('操作系统', '不限制', '类Unix', PHP_OS, 'success'),
			'php' => array('PHP版本', '5.4', '5.4+', PHP_VERSION, 'success'),
	        //'mysql'   => array('MYSQL版本', '5.4', '5.4+', '未知', 'success'), 
			'upload' => array('附件上传', '不限制', '2M+', '未知', 'success'),
			'gd' => array('GD库', '2.0', '2.0+', '未知', 'success'),
			'curl' => array('Curl扩展', '开启', '不限制', '未知', 'success'),
			'disk' => array('磁盘空间', '5M', '不限制', '未知', 'success'),
			);

	    //PHP环境检测
		if ($items['php'][3] < $items['php'][1]) {
			$items['php'][4] = 'danger';
			session('error', true);
		}

	    //附件上传检测
		if (@ini_get('file_uploads'))
			$items['upload'][3] = ini_get('upload_max_filesize');

	    //GD库检测
		$tmp = function_exists('gd_info') ? gd_info() : array();
		if (empty($tmp['GD Version'])) {
			$items['gd'][3] = '未安装';
			$items['gd'][4] = 'danger';
			session('error', true);
		} else {
			$items['gd'][3] = $tmp['GD Version'];
		}
		unset($tmp);

		$tmp = function_exists('curl_init') ? curl_version() : array();
		if (empty($tmp['version'])) {
			$items['curl'][3] = '未安装';
			$items['curl'][4] = 'danger';
			session('curl', true);
		} else {
			$items['curl'][3] = $tmp['version'];
		}
		unset($tmp);

		// $version = $this->mysqlVersion();
		// if(empty($tmp)){
		// 	$items['mysql'][3] = '未安装';
		// 	$items['mysql'][4] = 'danger';
		// }else{
		// 	$items['mysql'][3] = $version;
		// }
		// unset($version);

	    //磁盘空间检测
		if (function_exists('disk_free_space')) {
			$items['disk'][3] = floor(disk_free_space(INSTALL_APP_PATH) / (1024 * 1024)) . 'M';
		}

		return $items;
	}

	/**
	 * 目录，文件读写检测
	 * @return array 检测数据
	 */
	function checkDirfile()
	{
		$items = array(
			array('dir', '可写', 'ok', './Data/Backup'),
			array('dir', '可写', 'ok', './Data/Temp'),
			array('dir', '可写', 'ok', './Data/Cloud'),
			array('dir', '可写', 'ok', './Data/Update'),
			array('dir', '可写', 'ok', './Uploads/Download'),
			array('dir', '可写', 'ok', './Uploads/Picture'),
			array('dir', '可写', 'ok', './Uploads/Editor'),
			array('dir', '可写', 'ok', './Runtime'),
			array('file', '可写', 'ok', './Conf/user.php'),
			array('file', '可写', 'ok', './Conf/common.php'),

			);

		foreach ($items as &$val) {
			if ('dir' == $val[0]) {
				if (!is_writable(INSTALL_APP_PATH . $val[3])) {
					if (is_dir($items[1])) {
						$val[1] = '可读';
						$val[2] = 'danger';
						session('error', true);
					} else {
						$val[1] = '不存在或者不可写';
						$val[2] = 'danger';
						session('error', true);
					}
				}
			} else {
				if (file_exists(INSTALL_APP_PATH . $val[3])) {
					if (!is_writable(INSTALL_APP_PATH . $val[3])) {
						$val[1] = '文件存在但不可写';
						$val[2] = 'danger';
						session('error', true);
					}
				} else {
					if (!is_writable(dirname(INSTALL_APP_PATH . $val[3]))) {
						$val[1] = '不存在或者不可写';
						$val[2] = 'danger';
						session('error', true);
					}
				}
			}
		}

		return $items;
	}

	/**
	 * 获取数据库版本
	 * @return [string] 数据库版本
	 */
	public function mysqlVersion() {
		if ( $this->useMysqli ) {
			$serverInfo = mysqli_get_server_info(/*数据库信息*/);
		} else {
			$serverInfo = mysql_get_server_info(/*数据库信息*/);
		}
		return preg_replace( '/[^0-9.].*/', '', $serverInfo );
	}

	/**
	 * 设置属性useMysqli
	 */
	public function setUseMysqli(){
		$mysqlMethod = $this->checkMysqlMethod();
		switch ($mysqlMethod) {
			case 'mysqli_connect':
				$this->useMysqli = true;
				break;
			
			default:
				$this->useMysqli = false;
				break;
		}
	}

	/**
	 * 检测mysql链接方式
	 * @return [string] 支持的mysql链接方式
	 */
	public function checkMysqlMethod(){

		if(function_exists('mysqli_connect'))
			return 'mysqli_connect';

		return 'mysql_connect';
	}

	/**
	 * 函数检测
	 * @return array 检测数据
	 */
	public function checkFunc()
	{
		$items = array(
			array('file_get_contents', '支持', 'ok'),
			array('mb_strlen', '支持', 'ok'),
			array('curl_init', '支持', 'ok'),
			);

		if(function_exists('mysqli_connect')){
			$items[] =  array('mysqli_connect', '支持', 'ok');
		}else{
			$items[] = array('mysql_connect', '支持', 'ok');
		}


		foreach ($items as &$val) {
			if (!function_exists($val[0])) {
				$val[1] = '不支持';
				$val[2] = 'danger';
				$val[3] = '开启';
				session('error', true);
			}
		}

		return $items;
	}

}