<?php
$siteCodeArr = include('siteCode.php');

if(!empty($siteCodeArr)){
	define('SUP_SITE_CODE', current(array_values($siteCodeArr)));
	$siteCode = $siteCodeArr[$_SERVER[‘SERVER_NAME’]] ?: SUP_SITE_CODE;
	define('SITE_CODE', $siteCode);

	$siteFile = 'SiteConfig/'.$siteCode.'.php';
	$codeMetaFile = 'SiteMeta/'.$siteCode.'.php';

	$supSiteFile = 'SiteConfig/'.SUP_SITE_CODE.'.php';
	$supCodeMetaFile = 'SiteMeta/'.SUP_SITE_CODE.'.php';

	$system = array();
	$option = array();
	$siteSet = array();
	$siteMeta = array();

	if(file_exists('system.php'))
		$system = include('system.php');

	if(file_exists('option.php'))
		$option = include('option.php');

	if(file_exists($siteFile)){
		$siteSet = include($siteFile);
	}else{
		$siteSet = include($supSiteFile);
	}

	if(file_exists($codeMetaFile)){
		$siteMeta = include($codeMetaFile);
	}else{
		$siteMeta = include($supCodeMetaFile);
	}

	return array($system, $option, $siteSet, $siteMeta);
}

return array();
