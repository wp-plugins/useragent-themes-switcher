<?php
/*
Plugin Name: UserAgent Themes Switcher
Plugin URI: http://wordpress.org/plugins/useragent-themes-switcher/
Version: 1.4
Description: Switch the theme by the user agent. Can be specified user agent by a regular expression.
Author: Katsushi Kawamori
Author URI: http://riverforest-wp.info/
Text Domain: useragentthemesswitcher
Domain Path: /languages
*/

/*  Copyright (c) 2014- Katsushi Kawamori (email : dodesyoswift312@gmail.com)
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; version 2 of the License.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

	load_plugin_textdomain('useragentthemesswitcher', false, basename( dirname( __FILE__ ) ) . '/languages' );

	define("USERAGENTTHEMESSWITCHER_PLUGIN_BASE_FILE", plugin_basename(__FILE__));
	define("USERAGENTTHEMESSWITCHER_PLUGIN_BASE_DIR", dirname(__FILE__));
	define("USERAGENTTHEMESSWITCHER_PLUGIN_URL", plugins_url($path='',$scheme=null).'/useragent-content-switcher');
	require_once( USERAGENTTHEMESSWITCHER_PLUGIN_BASE_DIR . '/req/UserAgentThemesSwitcherRegist.php' );
	$useragentthemesswitcherregist = new UserAgentThemesSwitcherRegist();
	add_action('admin_init', array($useragentthemesswitcherregist, 'register_settings'));
	unset($useragentthemesswitcherregist);

	require_once( USERAGENTTHEMESSWITCHER_PLUGIN_BASE_DIR . '/req/UserAgentThemesSwitcherAdmin.php' );
	$useragentthemesswitcheradmin = new UserAgentThemesSwitcherAdmin();
	add_action( 'admin_menu', array($useragentthemesswitcheradmin, 'plugin_menu'));
	add_action( 'admin_enqueue_scripts', array($useragentthemesswitcheradmin, 'load_custom_wp_admin_style') );
	add_filter( 'plugin_action_links', array($useragentthemesswitcheradmin, 'settings_link'), 10, 2 );
	add_action( 'admin_footer', array($useragentthemesswitcheradmin, 'load_custom_wp_admin_style2') );
	unset($useragentthemesswitcheradmin);

	include_once( USERAGENTTHEMESSWITCHER_PLUGIN_BASE_DIR.'/inc/UserAgentThemesSwitcher.php' );
	$useragentthemesswitcher = new UserAgentThemesSwitcher();
	$mode = $useragentthemesswitcher->agent_check();
	add_filter('stylesheet', array($useragentthemesswitcher, 'LoadStyleTheme'));
	add_filter('template', array($useragentthemesswitcher, 'LoadTemplateTheme'));
	unset($useragentthemesswitcher);

?>