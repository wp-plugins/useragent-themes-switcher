<?php
/**
 * UserAgent Themes Switcher
 * 
 * @package    UserAgent Themes Switcher
 * @subpackage UserAgentThemesSwitcherRegist registered in the database
    Copyright (c) 2014- Katsushi Kawamori (email : dodesyoswift312@gmail.com)
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

class UserAgentThemesSwitcherRegist {

	/* ==================================================
	 * Settings register
	 * @since	1.0
	 */
	function register_settings(){

		$themes = wp_get_themes();
		$nowtheme = get_option('template');
		foreach ($themes as $theme) {
			if ( $nowtheme === $theme['Template'] ) {
				$nowtheme_name = $theme['Name'];
			}
		}

		if ( !get_option('useragentthemesswitcher_settings') ) {
			$settings_tbl = array(
							'device1' => array(
									'theme' => $nowtheme_name,
									'useragent' => 'iPad',
									'description' => 'iPad'
									),
							'device2' => array(
									'theme' => $nowtheme_name,
									'useragent' => '^.*Android.*Nexus(((?:(?!Mobile))|(?:(\s(7|10).+))).)*$|Kindle|Silk.*Accelerated|Sony.*Tablet|Xperia Tablet|Sony Tablet S|SAMSUNG.*Tablet|Galaxy.*Tab|SC-01C|SC-01D|SC-01E|SC-02D',
									'description' => 'Andoroid Tablet'
									),
							'device3' => array(
									'theme' => $nowtheme_name,
									'useragent' => 'iPhone|iPod',
									'description' => 'iPhone iPod'
									),
							'device4' => array(
									'theme' => $nowtheme_name,
									'useragent' => 'Android.*Mobile',
									'description' => 'Andoroid Smartphone'
									),
							'device5' => array(
									'theme' => $nowtheme_name,
									'useragent' => 'IEMobile',
									'description' => 'Microsoft Mobile'
									),
							'device6' => array(
									'theme' => $nowtheme_name,
									'useragent' => 'BlackBerry',
									'description' => 'BlackBerry'
									),
							'device7' => array(
									'theme' => $nowtheme_name,
									'useragent' => 'DoCoMo\/|KDDI-|UP\.Browser|SoftBank|Vodafone|J-PHONE|MOT-|WILLCOM|DDIPOCKET|PDXGW|emobile|ASTEL|L-mode',
									'description' => 'Japanese Mobile Phone'
									)
							);
			update_option( 'useragentthemesswitcher_settings', $settings_tbl );
		}

	}

}

?>