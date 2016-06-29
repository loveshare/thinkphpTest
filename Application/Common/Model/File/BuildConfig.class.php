<?php

namespace Common\Model\File;
use Think\Storage;  //文件操作库

class BuildConfig{

   //Storage::has
   //Storage::put
   //Storage::read
   /**
    * 根据模板生成配置文件
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

        if( $type == 'array')
            $pregString = '/^\'([A-Z_]+)\'([ ]+)=>/';
        else
            $pregString = '/^define\(\'([A-Z_]+)\',([ ]+)/';

        $setFuc = $type. 'ConfigSet';
        $keys = array_keys($List);

        if(empty($List))
            E('数据不能为空');

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
            chmod( $targetPath, 0777 );
            return true;
        }

        E('生成配置文件失败');

    }

    /**
     * 根据数据生成配置文件
     * @param  string $targetPath [description]
     * @param  string $key        [description]
     * @param  array  $List       [description]
     * @param  string $type       [description]
     * @return bool
     */
    public function createConfig($targetPath='' ,$key='', array $List ,$type='array' ){
        if(empty($List))
            E('要替换的字符不能为空');

        // if(empty($key))
        //     E('索引不能为空');

        if(empty($List))
            E('数据不能为空');

        $data = "<?php\r\n";
        $setFuc = $type. 'ConfigSet';
        $data .= $type=='array' ? "return array(\r\n" : '';

        if(empty($key)){
            foreach ($List as $k => $v) {
                $data .= $this->$setFuc($k, ' ', $v);
            }
        }else{
            foreach ($List as $k => $v) {
                $data .= $this->$setFuc($v['domain'], ' ', $v[$key]);
            }
        }

        $data .= $type=='array' ? ");" : '';

        if(Storage::put($targetPath,$data)){
            chmod( $targetPath, 0777 );
            return true;
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
    private function arrayConfigSet($constant,$padding=" ",$replace){
        return  "'". $constant ."'".$padding."=> ".$padding."'". $replace ."',\r\n";
    }

    /**
     * 生成常量配置文件操作类
     * @param  string $constant 目标字符
     * @param  string $padding 空格
     * @param  array $replace     替换的字符
     * @return string
     */
    private function defineConfigSet($constant,$padding=" ",$replace){
        return "define('" . $constant . "'," . $padding . "'" . $replace . "');\r\n";
    }


}
