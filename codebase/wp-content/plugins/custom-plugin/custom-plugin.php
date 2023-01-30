<?php

/*
Plugin Name: Custom Plugin
Plugin URI: https://github.com/DzmitryTsimashenka
Description: My custom plugin for Solberg soft.
Version: 0.1.0
Author: Dzmitry Tsimashenka
Author URI: https://github.com/DzmitryTsimashenka
*/

class MyCustomPlugin {
	public function __construct() {
		$this->init();
	}

	const MIN_PHP_VER = '7.4.0';

	public function init() {
		add_action( 'admin_init', array( 'MyCustomPlugin', 'pluginCanBeActivated' ) );
		add_filter( 'the_title', array( 'MyCustomPlugin', 'addPostDate' ) );
	}

	public static function pluginCanBeActivated() {
		$plugin           = 'custom-plugin/custom-plugin.php';
		$is_plugin_active = is_plugin_active( $plugin );
		$is_php_lower     = version_compare( PHP_VERSION, self::MIN_PHP_VER ) == - 1;

		if ( $is_plugin_active && $is_php_lower ) {
			add_action( 'admin_notices', array( 'MyCustomPlugin', 'notification' ) );
			deactivate_plugins( $plugin );

			unset( $_GET['activate'] );
		}
	}

	public static function notification() {
		$min_php_ver  = self::MIN_PHP_VER;
		$curr_php_ver = PHP_VERSION;
		$message      = "Plugin was deactivated because your PHP version is lower than current.
							<br>Current PHP version: $curr_php_ver
							<br> Minimum PHP version required: $min_php_ver";
		$class        = 'notice notice-error';

		printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message );
	}

	public static function addPostDate( $title ) {
		return is_singular('post') ? $title . ' ' . get_the_date() : $title;
	}
}

new MyCustomPlugin();
