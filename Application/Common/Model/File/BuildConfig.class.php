<?php

namespace Common\Model\File;
use Think\Storage;  //文件操作库

class BuildConfig{

    /**
    * 生成配置文件
    */
   //Storage::has
   //Storage::put
   //Storage::read
    public function setupConfig($sameplePath='' ,$targetPath='' ,array $List){

        if(Storage::has($sameplePath))
            $configFile = Storage::read($sameplePath);
        else
            E($sameplePath."不存在");
        if(Storage::has($targetPath))
            E($targetPath."已经存在");

        foreach ( $configFile as $lineNum => $line ) {
    		if ( '$table_prefix  =' == substr( $line, 0, 16 ) ) {
    			$configFile[ $lineNum ] = '$table_prefix  = \'' . addcslashes( $prefix, "\\'" ) . "';\r\n";
    			continue;
    		}

    		if ( ! preg_match( '/^define\(\'([A-Z_]+)\',([ ]+)/', $line, $match ) )
    			continue;

    		$constant = $match[1];
    		$padding  = $match[2];

    		switch ( $constant ) {
    			case 'DB_NAME'     :
    			case 'DB_USER'     :
    			case 'DB_PASSWORD' :
    			case 'DB_HOST'     :
    				$configFile[ $lineNum ] = "define('" . $constant . "'," . $padding . "'" . addcslashes( constant( $constant ), "\\'" ) . "');\r\n";
    				break;
    			case 'DB_CHARSET'  :
    				if ( 'utf8mb4' === $wpdb->charset || ( ! $wpdb->charset && $wpdb->has_cap( 'utf8mb4' ) ) ) {
    					$config_file[ $line_num ] = "define('" . $constant . "'," . $padding . "'utf8mb4');\r\n";
    				}
    				break;
    			case 'AUTH_KEY'         :
    			case 'SECURE_AUTH_KEY'  :
    			case 'LOGGED_IN_KEY'    :
    			case 'NONCE_KEY'        :
    			case 'AUTH_SALT'        :
    			case 'SECURE_AUTH_SALT' :
    			case 'LOGGED_IN_SALT'   :
    			case 'NONCE_SALT'       :
    				$configFile[ $lineNum ] = "define('" . $constant . "'," . $padding . "'" . $secret_keys[$key++] . "');\r\n";
    				break;
    		}
    	}
    	Storage::put($targetPath,$configFile);
    }


}
