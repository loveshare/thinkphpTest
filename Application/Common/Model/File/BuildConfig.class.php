<?php

namespace Common\Model\File;
use Think\Storage;  //文件操作库

class BuildConfig{

   //Storage::has
   //Storage::put
   //Storage::read
   /**
    * 生成配置文件
    * @param  string $sameplePath 源文件
    * @param  string $targetPath  目标文件
    * @param  array  $List        要过滤的数据
    * @param  string $type        array define
    * @return boole  
    */
    public function setupConfig($sameplePath='' ,$targetPath='' ,array $List ,$type='array'){
        if(empty($List))
            E('要替换的字符不能为空');

        if(Storage::has($sameplePath))
            $configFile = file($sameplePath);
        else
            E('源文件不存在');

        // if(Storage::has($targetPath))
        //     E('目标文件已存在');

        if( $type == 'array')
            $pregString = '/^\'([A-Z_]+)\'([ ]+)=>/';
        else
            $pregString = '/^define\(\'([A-Z_]+)\',([ ]+)/';

        $setFuc = $type. 'ConfigSet';
        $keys = array_keys($List);

        foreach ( $configFile as $lineNum => $line ) {

    		if ( ! preg_match( $pregString, $line, $match ) )
    			continue;

    		$constant = $match[1];
    		$padding  = $match[2];

            if(!in_array($constant,$keys))
                continue;

            $configFile[ $lineNum ] = $this->$setFuc($constant, $padding, $List[$constant]);
    	}
    	if(Storage::put($targetPath,$configFile)){
            return true;
            chmod( $targetPath, 0777 );
        }

        E('生成配置文件失败');

    }

    /**
     * 生成数组配置文件操作类
     * @param  string $constant 目标字符
     * @param  string $padding 空格
     * @param  array $replace     替换的字符
     * @return string
     */
    private function arrayConfigSet($constant,$padding,$replace){
        return  "'". $constant ."'".$padding."=> ".$padding."'". $replace ."',\r\n";
    }

    /**
     * 生成常量配置文件操作类
     * @param  string $constant 目标字符
     * @param  string $padding 空格
     * @param  array $replace     替换的字符
     * @return string
     */
    private function defineConfigSet($constant,$padding,$replace){
        return "define('" . $constant . "'," . $padding . "'" . $replace . "');\r\n";
    }


}
