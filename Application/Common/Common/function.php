<?php

/**
 * 系统非常规MD5加密方法
 * @param  string $str 要加密的字符串
 * @return string
 */
function userMd5($str, $key = '')
{
    return '' === $str ? '' : md5(sha1($str));
}

/*
 * 时间转换
 */
function timeFilter($time) {
    $diff = time() - $time;
    if ($diff < 0) {
        return '未来';
    }

    if ($diff == 0) {
        return '刚刚';
    }

    if ($diff < 60) {
        return $diff . '秒前';
    }

    if ($diff < 3600) {
        return round($diff / 60) . '分钟前';
    }

    if ($diff < 86400) {
        return round($diff / 3600) . '小时前';
    }

    if ($diff < 2592000) {
        return round($diff / 86400) . '天前';
    }

    if ($diff < 31536000) {
        return date('m-d', $time);
    }

    return date('Y-m-d', $time);
}

/**
 * 获取客户端操作系统
 */
function getplat() {
    $agent = $_SERVER['HTTP_USER_AGENT'];
    $os = false;

    if (eregi('win', $agent)) {
        $os = 'Windows';
    } else if (eregi('linux', $agent)) {
        $os = 'Linux';
    } else if (eregi('unix', $agent)) {
        $os = 'Unix';
    } else if (eregi('sun', $agent) && eregi('os', $agent)) {
        $os = 'SunOS';
    } else if (eregi('ibm', $agent) && eregi('os', $agent)) {
        $os = 'IBM OS/2';
    } else if (eregi('Mac', $agent) && eregi('PC', $agent)) {
        $os = 'Macintosh';
    } else if (eregi('PowerPC', $agent)) {
        $os = 'PowerPC';
    } else if (eregi('AIX', $agent)) {
        $os = 'AIX';
    } else if (eregi('HPUX', $agent)) {
        $os = 'HPUX';
    } else if (eregi('NetBSD', $agent)) {
        $os = 'NetBSD';
    } else if (eregi('BSD', $agent)) {
        $os = 'BSD';
    } else if (ereg('OSF1', $agent)) {
        $os = 'OSF1';
    } else if (ereg('IRIX', $agent)) {
        $os = 'IRIX';
    } else if (eregi('FreeBSD', $agent)) {
        $os = 'FreeBSD';
    } else if (eregi('teleport', $agent)) {
        $os = 'teleport';
    } else if (eregi('flashget', $agent)) {
        $os = 'flashget';
    } else if (eregi('webzip', $agent)) {
        $os = 'webzip';
    } else if (eregi('offline', $agent)) {
        $os = 'offline';
    } else {
        $os = 'Unknown';
    }
    return $os;
}

/**
 * 及时显示提示信息
 * @param  string $msg 提示信息
 */
function show_msg($msg, $class = '')
{
    echo "<script type=\"text/javascript\">showmsg(\"{$msg}\", \"{$class}\")</script>";
    ob_flush();
    flush();
}

/**
 * 将一个值转换为非负整数。
 *
 * @param mixed $numberic 数字或数字字符串
 * @return int 一个非负整数
 */
function absint( $numberic ) {
	return abs( intval( $maybeint ) );
}

/**
 * Unserialize value only if it was serialized.
 *
 * @param string $original Maybe unserialized original, if is needed.
 * @return mixed Unserialized data can be any type.
 */
function maybeUnserialize( $original ) {
	if ( isSerialized( $original ) )
		return @unserialize( $original );
	return $original;
}

/**
 * Check value to find if it was serialized.
 *
 * @param string $data   Value to check to see if was serialized.
 * @param bool   $strict Optional. Whether to be strict about the end of the string. Default true.
 * @return bool False if not serialized and true if it was.
 */
function isSerialized( $data, $strict = true ) {
	if ( ! is_string( $data ) ) {
		return false;
	}
	$data = trim( $data );
 	if ( 'N;' == $data ) {
		return true;
	}
	if ( strlen( $data ) < 4 ) {
		return false;
	}
	if ( ':' !== $data[1] ) {
		return false;
	}
	if ( $strict ) {
		$lastc = substr( $data, -1 );
		if ( ';' !== $lastc && '}' !== $lastc ) {
			return false;
		}
	} else {
		$semicolon = strpos( $data, ';' );
		$brace     = strpos( $data, '}' );
		// Either ; or } must exist.
		if ( false === $semicolon && false === $brace )
			return false;
		// But neither must be in the first X characters.
		if ( false !== $semicolon && $semicolon < 3 )
			return false;
		if ( false !== $brace && $brace < 4 )
			return false;
	}
	$token = $data[0];
	switch ( $token ) {
		case 's' :
			if ( $strict ) {
				if ( '"' !== substr( $data, -2, 1 ) ) {
					return false;
				}
			} elseif ( false === strpos( $data, '"' ) ) {
				return false;
			}
			// or else fall through
		case 'a' :
		case 'O' :
			return (bool) preg_match( "/^{$token}:[0-9]+:/s", $data );
		case 'b' :
		case 'i' :
		case 'd' :
			$end = $strict ? '$' : '';
			return (bool) preg_match( "/^{$token}:[0-9.E-]+;$end/", $data );
	}
	return false;
}

/**
 * Check whether serialized data is of string type.
 *
 * @param string $data Serialized data.
 * @return bool False if not a serialized string, true if it is.
 */
function isSerializedString( $data ) {
	// if it isn't a string, it isn't a serialized string.
	if ( ! is_string( $data ) ) {
		return false;
	}
	$data = trim( $data );
	if ( strlen( $data ) < 4 ) {
		return false;
	} elseif ( ':' !== $data[1] ) {
		return false;
	} elseif ( ';' !== substr( $data, -1 ) ) {
		return false;
	} elseif ( $data[0] !== 's' ) {
		return false;
	} elseif ( '"' !== substr( $data, -2, 1 ) ) {
		return false;
	} else {
		return true;
	}
}

/**
 * Serialize data, if needed.
 *
 * @param string|array|object $data Data that might be serialized.
 * @return mixed A scalar data
 */
function maybeSerialize( $data ) {
	if ( is_array( $data ) || is_object( $data ) )
		return serialize( $data );

	if ( isSerialized( $data, false ) )
		return serialize( $data );

	return $data;
}

/**
 * 提取一个数组的数据，给定一个键列表。
 *
 * @param array $array The original array.
 * @param array $keys  The list of keys.
 * @return array The array slice.
 */
function arraySliceAssoc( $array, $keys ) {
	$slice = array();
	foreach ( $keys as $key )
		if ( isset( $array[ $key ] ) )
			$slice[ $key ] = $array[ $key ];

	return $slice;
}


/**
 * 确定变量是否是一个数字索引数组。
 *
 * @param mixed $data 要检测的数据
 * @return bool
 */
function isNumericArray( $data ) {
	if ( ! is_array( $data ) ) {
		return false;
	}

	$keys = array_keys( $data );
	$string_keys = array_filter( $keys, 'is_string' );
	return count( $string_keys ) === 0;
}

/**
 * 检测路径是否位局对路径
 *
 * For example, '/foo/bar', or 'c:\windows'.
 *
 * @param string $path File path.
 * @return bool True if path is absolute, false is not absolute.
 */
function pathIsAbsolute( $path ) {

	if ( realpath($path) == $path )
		return true;

	if ( strlen($path) == 0 || $path[0] == '.' )
		return false;

	if ( preg_match('#^[a-zA-Z]:\\\\#', $path) )
		return true;

	return ( $path[0] == '/' || $path[0] == '\\' );
}

/**
 * 返回规范的路径
 *
 * @param string $path Path to normalize.
 * @return string Normalized path.
 */
function normalizePath( $path ) {
	$path = str_replace( '\\', '/', $path );
	$path = preg_replace( '|/+|','/', $path );
	if ( ':' === substr( $path, 1, 1 ) ) {
		$path = ucfirst( $path );
	}
	return $path;
}

/**
 * Determine if a directory is writable.
 *
 * @param string $path Path to check for write-ability.
 * @return bool Whether the path is writable.
 */
function isWritable( $path ) {
	if ( 'WIN' === strtoupper( substr( PHP_OS, 0, 3 ) ) )
		return winIsWritable( $path );
	else
		return @is_writable( $path );
}

/**
 * Workaround for Windows bug in is_writable() function
 *
 * @param string $path Windows path to check for write-ability.
 * @return bool Whether the path is writable.
 */
function winIsWritable( $path ) {

	if ( $path[strlen( $path ) - 1] == '/' ) {
        //如果似乎是一个目录路径 随机内部的文件
		return winIsWritable( $path . uniqid( mt_rand() ) . '.tmp');
	} elseif ( is_dir( $path ) ) {
        //如果一个目录（不是一个文件）在这个目录中随机检测文件
		return winIsWritable( $path . '/' . uniqid( mt_rand() ) . '.tmp' );
	}
	// 检测临时文件读写能力
	$should_delete_tmp_file = !file_exists( $path );
	$f = @fopen( $path, 'a' );
	if ( $f === false )
		return false;
	fclose( $f );
	if ( $should_delete_tmp_file )
		unlink( $path );
	return true;
}

/**
 * Determine if SSL is used.
 *
 * @return bool True if SSL, false if not used.
 */
function isSsl() {
	if ( isset($_SERVER['HTTPS']) ) {
		if ( 'on' == strtolower($_SERVER['HTTPS']) )
			return true;
		if ( '1' == $_SERVER['HTTPS'] )
			return true;
	} elseif ( isset($_SERVER['SERVER_PORT']) && ( '443' == $_SERVER['SERVER_PORT'] ) ) {
		return true;
	}
	return false;
}
//$schema = is_ssl() ? 'https://' : 'http://';
