<?php

namespace Common\Model\File;
use Think\Storage;  //文件操作库

class FileRWModel{

    /**
    * 生成配置文件
    */
   //Storage：：has
   //Storage::put
   //Storage::read
    public function setupConfig($sameplePath='' ,$targetPath='' ,array $List){
        if ( file_exists( ABSPATH . 'wp-config-sample.php' ) )
        	$config_file = file( ABSPATH . 'wp-config-sample.php' );
        elseif ( file_exists( dirname( ABSPATH ) . '/wp-config-sample.php' ) )
        	$config_file = file( dirname( ABSPATH ) . '/wp-config-sample.php' );
        else
        	E( 'Sorry, I need a wp-config-sample.php file to work from. Please re-upload this file to your WordPress installation.' );
        if ( file_exists( ABSPATH . 'wp-config.php' ) )
        	E("pei zhi wen jian yi cun zai !");

        foreach ( $config_file as $line_num => $line ) {
    		if ( '$table_prefix  =' == substr( $line, 0, 16 ) ) {
    			$config_file[ $line_num ] = '$table_prefix  = \'' . addcslashes( $prefix, "\\'" ) . "';\r\n";
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
    				$config_file[ $line_num ] = "define('" . $constant . "'," . $padding . "'" . addcslashes( constant( $constant ), "\\'" ) . "');\r\n";
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
    				$config_file[ $line_num ] = "define('" . $constant . "'," . $padding . "'" . $secret_keys[$key++] . "');\r\n";
    				break;
    		}
    	}
    	unset( $line );

        if ( file_exists( ABSPATH . 'wp-config-sample.php' ) )
			$path_to_wp_config = ABSPATH . 'wp-config.php';
		else
			$path_to_wp_config = dirname( ABSPATH ) . '/wp-config.php';

		$handle = fopen( $targetPath, 'w' );
		foreach ( $config_file as $line ) {
			fwrite( $handle, $line );
		}
		fclose( $handle );
		chmod( $targetPath, 0666 );
    }


}
