<?php
namespace Base\Controller;

use Think\View;
use Think\Storage;
use Think\Hook;

class BaseView extends View {

	/**
     * 加载模板和页面输出 可以返回输出内容
     * @access public
     * @param array $options 自定义数据'customType'=>false,'dataType'=>'json'
     * @param string $templateFile 模板文件名
     * @param string $charset 模板输出字符集
     * @param string $contentType 输出类型
     * @param string $content 模板输出内容
     * @param string $prefix 模板缓存前缀
     * @return mixed
     */
    public function displayi($templateFile='',$charset='',$contentType='',$content='',$prefix='') {
        G('viewStartTime');
        // 视图开始标签
        Hook::listen('view_begin',$templateFile);
        // 解析并获取模板内容
        $content = $this->fetchi($templateFile,$content,$prefix);
        // 输出模板内容
        $this->baseRender($content,$charset,$contentType);
        // 视图结束标签
        Hook::listen('view_end');
    }

    /**
     * 输出内容文本可以包括Html
     * @access private
     * @param string $content 输出内容
     * @param string $charset 模板输出字符集
     * @param string $contentType 输出类型
     * @return mixed
     */

    private function baseRender($content,$charset='',$contentType=''){
        if(empty($charset))  $charset = C('DEFAULT_CHARSET');
        if(empty($contentType)) $contentType = C('TMPL_CONTENT_TYPE');
        // 网页字符编码
        header('Content-Type:'.$contentType.'; charset='.$charset);
        header('Cache-control: '.C('HTTP_CACHE_CONTROL'));  // 页面缓存控制
        header('X-Powered-By:ThinkPHP');
        // 输出模板文件
        echo $content;
    }

    /**
     * 解析和获取模板内容 用于输出
     * @access public
     * @param string $templateFile 模板文件名
     * @param string $content 模板输出内容
     * @param string $prefix 模板缓存前缀
     * @return string
     */
    public function fetchi($templateFile='',$content='',$prefix='') {
        if(empty($content)) {
            $templateFile   =   $this->parseTemplatei($templateFile);
            // 模板文件不存在直接返回
            if(!is_file($templateFile)) E(L('_TEMPLATE_NOT_EXIST_').':'.$templateFile);
        }else{
            defined('THEME_PATH') or    define('THEME_PATH', $this->getThemePathi());
        }
        // 页面缓存
        ob_start();
        ob_implicit_flush(0);
        if('php' == strtolower(C('TMPL_ENGINE_TYPE'))) { // 使用PHP原生模板
            $_content   =   $content;
            // 模板阵列变量分解成为独立变量
            extract($this->tVar, EXTR_OVERWRITE);
            // 直接载入PHP模板
            empty($_content)?include $templateFile:eval('?>'.$_content);
        }else{
            // 视图解析标签
            $params = array('var'=>$this->tVar,'file'=>$templateFile,'content'=>$content,'prefix'=>$prefix);
            Hook::listen('view_parse',$params);
        }
        // 获取并清空缓存
        $content = ob_get_clean();
        // 内容过滤标签
        Hook::listen('view_filter',$content);
        // 输出模板文件
        return $content;
    }

    /**
     * 自动定位模板文件
     * @access protected
     * @param string $template 模板文件规则
     * @return string
     */
    public function parseTemplatei($template='') {

        if(is_file($template)) {
            return $template;
        }
        $depr       =   C('TMPL_FILE_DEPR');
        $template   =   str_replace(':', $depr, $template);

        // 获取当前模块
        $module   =  MODULE_NAME;
        if(strpos($template,'@')){ // 跨模块调用模版文件
            list($module,$template)  =   explode('@',$template);
        }
        // 获取当前主题的模版路径
        defined('THEME_PATH') or    define('THEME_PATH', $this->getThemePathi($module));

        // 分析模板文件规则
        if('' == $template) {
            // 如果模板文件名为空 按照默认规则定位
            $template = CONTROLLER_NAME . $depr . ACTION_NAME;
        }elseif(false === strpos($template, $depr)){
            $template = CONTROLLER_NAME . $depr . $template;
        }
        $file   =   THEME_PATH.$template.C('TMPL_TEMPLATE_SUFFIX');
        if(C('TMPL_LOAD_DEFAULTTHEME') && THEME_NAME != C('DEFAULT_THEME') && !is_file($file)){
            // 找不到当前主题模板的时候定位默认主题中的模板
            $file   =   dirname(THEME_PATH).'/'.C('DEFAULT_THEME').'/'.$template.C('TMPL_TEMPLATE_SUFFIX');
        }
        return $file;
    }

    /**
     * 获取当前的模板路径
     * @access protected
     * @param  string $module 模块名
     * @return string
     */
    protected function getThemePathi($module=MODULE_NAME){
        // 获取当前主题名称
        $theme = C('theme');
        // 获取当前主题的模版路径

        // 定义TMPL_PATH 则改变全局的视图目录到模块之外
        $tmplPath = themePath().$module.'/';

        $this->setVarThemePath($tmplPath);
        return $tmplPath;
    }

    /**
     * 获取当前的模板路径
     * @access protected
     * @param  string $module 模块名
     * @return string
     */
    protected function getThemePath($module=MODULE_NAME){
        parent::getThemePath($module);
        // 获取当前主题名称
        $theme = $this->getTemplateTheme();
        // 获取当前主题的模版路径
        $tmplPath   =   C('VIEW_PATH'); // 模块设置独立的视图目录
        if(!$tmplPath){
            // 定义TMPL_PATH 则改变全局的视图目录到模块之外
            $tmplPath   =   defined('TMPL_PATH')? TMPL_PATH.$module.'/' : APP_PATH.$module.'/'.C('DEFAULT_V_LAYER').'/';
        }

        $this->setVarThemePath($tmplPath);
        return $tmplPath.$theme;
    }

    /**
     * 设置模板路径变量
     * @param [string] $tmplPath 模板路径
     */
    public function setVarThemePath($tmplPath){
        $tmplPath = str_replace('./', '/', $tmplPath);
        $this->assign('themePath',$tmplPath);
    }

    /**
     * 获取当前的模板主题
     * @access private
     * @return string
     */
    private function getTemplateThemei() {
        if($this->theme) { // 指定模板主题
            $theme = $this->theme;
        }else{
            /* 获取模板主题名称 */
            $theme =  C('DEFAULT_THEME');
            if(C('TMPL_DETECT_THEME')) {// 自动侦测模板主题
                $t = C('VAR_TEMPLATE');
                if (isset($_GET[$t])){
                    $theme = $_GET[$t];
                }elseif(cookie('think_template')){
                    $theme = cookie('think_template');
                }
                if(!in_array($theme,explode(',',C('THEME_LIST')))){
                    $theme =  C('DEFAULT_THEME');
                }
                cookie('think_template',$theme,864000);
            }
        }
        defined('THEME_NAME') || define('THEME_NAME',   $theme);                  // 当前模板主题名称
        return $theme?$theme . '/':'';
    }

    private function baseControlle(){
        return (new BaseController);
    }
}
