<?php

if ( file_exists( ABSPATH . 'wp-config-sample.php' ) )
	$config_file = file( ABSPATH . 'wp-config-sample.php' );
$key = 0;
	// Not a PHP5-style by-reference foreach, as this file must be parseable by PHP4.
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

	if ( ! is_writable(ABSPATH) ) :
		setup_config_display_header();
