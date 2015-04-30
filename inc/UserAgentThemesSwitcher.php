<?php
/**
 * UserAgent Themes Switcher
 * 
 * @package    UserAgent Themes Switcher
 * @subpackage UserAgentThemesSwitcher Main Functions
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

class UserAgentThemesSwitcher {

	/* ==================================================
	* @param	none
	* @return	string	$device
	* @since	1.0
	*/
	function agent_check(){

		$user_agent = $_SERVER['HTTP_USER_AGENT'];

		$useragentthemesswitcher_settings = get_option('useragentthemesswitcher_settings');

		if(preg_match("{".$useragentthemesswitcher_settings['device1']['useragent']."}",$user_agent)){
			$device = 'device1'; 
		}else if(preg_match("{".$useragentthemesswitcher_settings['device2']['useragent']."}",$user_agent)){
			$device = 'device2'; 
		}else if(preg_match("{".$useragentthemesswitcher_settings['device3']['useragent']."}",$user_agent)){
			$device = 'device3'; 
		}else if(preg_match("{".$useragentthemesswitcher_settings['device4']['useragent']."}",$user_agent)){
			$device = 'device4'; 
		}else if(preg_match("{".$useragentthemesswitcher_settings['device5']['useragent']."}",$user_agent)){
			$device = 'device5'; 
		}else if(preg_match("{".$useragentthemesswitcher_settings['device6']['useragent']."}",$user_agent)){
			$device = 'device6'; 
		}else if(preg_match("{".$useragentthemesswitcher_settings['device7']['useragent']."}",$user_agent)){
			$device = 'device7'; 
		}else{
			$device = 'device0'; 
		}

		return $device;

	}

	/* ==================================================
	* @param	none
	* @return	string	Stylesheet Name
	* @since	1.0
	*/
	function LoadStyleTheme(){

		$themes = wp_get_themes();
		$nowtheme = get_option('template');
		$nowtheme_stylesheet = get_option('stylesheet');

		$device = $this->agent_check();
		if( $device === 'device0' ){
			return $nowtheme_stylesheet;
		} else {
			$useragentthemesswitcher_settings = get_option('useragentthemesswitcher_settings');
			$theme_name = $useragentthemesswitcher_settings[$device]['theme'];
			foreach ($themes as $theme) {
				if ($theme['Name'] === $theme_name) {
					return $theme['Stylesheet'];
				}
			}
		}

	}

	/* ==================================================
	* @param	none
	* @return	string	Template Name
	* @since	1.0
	*/
	function LoadTemplateTheme(){

		$themes = wp_get_themes();
		$nowtheme = get_option('Template');
		foreach ($themes as $theme) {
			if ( $nowtheme === $theme['Template'] ) {
				$nowtheme_template = $theme['Template'];
			}
		}

		$device = $this->agent_check();
		if( $device === 'device0' ){
			return $nowtheme_template;
		} else {
			$useragentthemesswitcher_settings = get_option('useragentthemesswitcher_settings');
			$theme_name = $useragentthemesswitcher_settings[$device]['theme'];
			foreach ($themes as $theme) {
				if ($theme['Name'] === $theme_name) {
					return $theme['Template'];
				}
			}
		}

	}

}

?>