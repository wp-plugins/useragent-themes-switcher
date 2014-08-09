<?php
/*
Plugin Name: UserAgent Themes Switcher
Plugin URI: http://wordpress.org/plugins/useragent-themes-switcher/
Version: 1.0
Description: Switch the theme by the user agent. Can be specified user agent by a regular expression.
Author: Katsushi Kawamori
Author URI: http://gallerylink.nyanko.org/
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

	require_once( dirname( __FILE__ ) . '/req/UserAgentThemesSwitcherRegist.php' );
	$useragentthemesswitcherregist = new UserAgentThemesSwitcherRegist();
	add_action('admin_init', array($useragentthemesswitcherregist, 'register_settings'));
	unset($useragentthemesswitcherregist);

	require_once( dirname( __FILE__ ) . '/req/UserAgentThemesSwitcherAdmin.php' );
	$useragentthemesswitcheradmin = new UserAgentThemesSwitcherAdmin();
	add_action( 'admin_menu', array($useragentthemesswitcheradmin, 'plugin_menu'));
	add_filter( 'plugin_action_links', array($useragentthemesswitcheradmin, 'settings_link'), 10, 2 );
	unset($useragentthemesswitcheradmin);

	include_once dirname(__FILE__).'/inc/UserAgentThemesSwitcher.php';
	$useragentthemesswitcher = new UserAgentThemesSwitcher();
	$mode = $useragentthemesswitcher->agent_check();
	add_filter('stylesheet', array($useragentthemesswitcher, 'LoadStyleTheme'));
	add_filter('template', array($useragentthemesswitcher, 'LoadTemplateTheme'));
	unset($useragentthemesswitcher);

?>