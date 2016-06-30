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

	$system = @include('system.php');

	$option = @include('option.php');

	$siteSet = @include($siteFile);
	if(empty($siteSet))
		$siteSet = @include($supSiteFile);

	$siteMeta = @include($codeMetaFile);
	if(empty($siteMeta))
		$siteMeta = @include($supCodeMetaFile);

	$themeFile = 'Theme/'.$siteMeta['theme'].SITE_CODE.'.php';
	$supThemeFile = 'Theme/'.$system['theme'].SUP_SITE_CODE.'.php';
	$theme = @include($themeFile);
	if(empty($theme))
		$theme = @include($supThemeFile);

	$system = $system ?: array();
	$option = $option ?: array();
	$siteSet = $siteSet ?: array();
	$siteMeta = $siteMeta ?: array();
	$theme = $theme ?: array();
	
	return array_merge($system, $option, $siteSet, $siteMeta, $theme);
}

return array();
