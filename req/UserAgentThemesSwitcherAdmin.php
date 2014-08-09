<?php
/**
 * UserAgent Themes Switcher
 * 
 * @package    UserAgent Themes Switcher
 * @subpackage UserAgentThemesSwitcherAdmin Management screen
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

class UserAgentThemesSwitcherAdmin {

	/* ==================================================
	 * Add a "Settings" link to the plugins page
	 * @since	1.0
	 */
	function settings_link($links, $file) {
		static $this_plugin;
		if ( empty($this_plugin) ) {
			$this_plugin = USERAGENTTHEMESSWITCHER_PLUGIN_BASE_FILE;
		}
		if ( $file == $this_plugin ) {
			$links[] = '<a href="'.admin_url('options-general.php?page=UserAgentThemesSwitcher').'">'.__( 'Settings').'</a>';
		}
		return $links;
	}

	/* ==================================================
	 * Settings page
	 * @since	1.0
	 */
	function plugin_menu() {
		add_options_page( 'UserAgentThemesSwitcher Options', 'UserAgent Themes Switcher', 'manage_options', 'UserAgentThemesSwitcher', array($this, 'plugin_options') );
	}

	/* ==================================================
	 * Settings page
	 * @since	1.0
	 */
	function plugin_options() {
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}

		$pluginurl = plugins_url($path='',$scheme=null);

		wp_enqueue_style( 'jquery-ui-tabs', $pluginurl.'/useragent-themes-switcher/css/jquery-ui.css' );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-tabs' );
		wp_enqueue_script( 'jquery-ui-tabs-in', $pluginurl.'/useragent-themes-switcher/js/jquery-ui-tabs-in.js' );

		if( !empty($_POST) ) { 
			$this->options_updated();
		}

		$scriptname = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH).'?page=UserAgentThemesSwitcher';
		$useragentthemesswitcher_settings = get_option('useragentthemesswitcher_settings');
		$themes = wp_get_themes();

		?>
		<div class="wrap">
			<h2>UserAgent Themes Switcher</h2>
			<div id="tabs">
				<ul>
				<li><a href="#tabs-1"><?php _e('Settings'); ?></a></li>
				<!--
				<li><a href="#tabs-2"><?php _e('FAQ'); ?></a></li>
				 -->
				</ul>
				<div id="tabs-1">
					<div class="wrap">
					<form method="post" action="<?php echo $scriptname; ?>">
						<h2><?php _e('Settings of user agent and theme', 'useragentthemesswitcher') ?></h2>
						<p class="submit">
							<input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
						</p>
						<table class="wp-list-table widefat">
						<tbody>
							<tr>
								<td align="center" valign="middle"><?php _e('Themes'); ?></td>
								<td align="center" valign="middle"><?php _e('User Agent[| Specify separated by. Regular expression is possible.]', 'useragentthemesswitcher'); ?></td>
								<td align="center" valign="middle"><?php _e('Description'); ?></td>
							</tr>
							<tr>
								<td align="center" valign="middle">
								<select name="useragentthemesswitcher_selecttheme1">
								<?php
								foreach ($themes as $theme) {
									if ( $useragentthemesswitcher_settings['device1']['theme'] === $theme['Name'] ) {
									?>
										<option value="<?php echo $theme['Name']; ?>" selected><?php echo $theme['Name']; ?></option>
									<?php

									} else {
									?>
										<option value="<?php echo $theme['Name']; ?>"><?php echo $theme['Name']; ?></option>
									<?php
									}
								}
								?>
								</select>
								</td>
								<td align="center" valign="middle">
									<textarea name="useragentthemesswitcher_useragent1" rows="4" cols="60"><?php echo $useragentthemesswitcher_settings['device1']['useragent']; ?></textarea>
								</td>
								<td align="center" valign="middle"><input type="text" name="useragentthemesswitcher_description1" value="<?php echo $useragentthemesswitcher_settings['device1']['description']; ?>"></td>
							</tr>
							<tr>
								<td align="center" valign="middle">
								<select name="useragentthemesswitcher_selecttheme2">
								<?php
								foreach ($themes as $theme) {
									if ( $useragentthemesswitcher_settings['device2']['theme'] === $theme['Name'] ) {
									?>
										<option value="<?php echo $theme['Name']; ?>" selected><?php echo $theme['Name']; ?></option>
									<?php

									} else {
									?>
										<option value="<?php echo $theme['Name']; ?>"><?php echo $theme['Name']; ?></option>
									<?php
									}
								}
								?>
								</select>
								</td>
								<td align="center" valign="middle">
									<textarea name="useragentthemesswitcher_useragent2" rows="4" cols="60"><?php echo $useragentthemesswitcher_settings['device2']['useragent']; ?></textarea>
								</td>
								<td align="center" valign="middle"><input type="text" name="useragentthemesswitcher_description2" value="<?php echo $useragentthemesswitcher_settings['device2']['description']; ?>"></td>
							</tr>
							<tr>
								<td align="center" valign="middle">
								<select name="useragentthemesswitcher_selecttheme3">
								<?php
								foreach ($themes as $theme) {
									if ( $useragentthemesswitcher_settings['device3']['theme'] === $theme['Name'] ) {
									?>
										<option value="<?php echo $theme['Name']; ?>" selected><?php echo $theme['Name']; ?></option>
									<?php

									} else {
									?>
										<option value="<?php echo $theme['Name']; ?>"><?php echo $theme['Name']; ?></option>
									<?php
									}
								}
								?>
								</select>
								</td>
								<td align="center" valign="middle">
									<textarea name="useragentthemesswitcher_useragent3" rows="4" cols="60"><?php echo $useragentthemesswitcher_settings['device3']['useragent']; ?></textarea>
								</td>
								<td align="center" valign="middle"><input type="text" name="useragentthemesswitcher_description3" value="<?php echo $useragentthemesswitcher_settings['device3']['description']; ?>"></td>
							</tr>
							<tr>
								<td align="center" valign="middle">
								<select name="useragentthemesswitcher_selecttheme4">
								<?php
								foreach ($themes as $theme) {
									if ( $useragentthemesswitcher_settings['device4']['theme'] === $theme['Name'] ) {
									?>
										<option value="<?php echo $theme['Name']; ?>" selected><?php echo $theme['Name']; ?></option>
									<?php

									} else {
									?>
										<option value="<?php echo $theme['Name']; ?>"><?php echo $theme['Name']; ?></option>
									<?php
									}
								}
								?>
								</select>
								</td>
								<td align="center" valign="middle">
									<textarea  name="useragentthemesswitcher_useragent4" rows="4" cols="60"><?php echo $useragentthemesswitcher_settings['device4']['useragent']; ?></textarea>
								</td>
								<td align="center" valign="middle"><input type="text" name="useragentthemesswitcher_description4" value="<?php echo $useragentthemesswitcher_settings['device4']['description']; ?>"></td>
							</tr>
							<tr>
								<td align="center" valign="middle">
								<select name="useragentthemesswitcher_selecttheme5">
								<?php
								foreach ($themes as $theme) {
									if ( $useragentthemesswitcher_settings['device5']['theme'] === $theme['Name'] ) {
									?>
										<option value="<?php echo $theme['Name']; ?>" selected><?php echo $theme['Name']; ?></option>
									<?php

									} else {
									?>
										<option value="<?php echo $theme['Name']; ?>"><?php echo $theme['Name']; ?></option>
									<?php
									}
								}
								?>
								</select>
								</td>
								<td align="center" valign="middle">
									<textarea name="useragentthemesswitcher_useragent5" rows="4" cols="60"><?php echo $useragentthemesswitcher_settings['device5']['useragent']; ?></textarea>
								</td>
								<td align="center" valign="middle"><input type="text" name="useragentthemesswitcher_description5" value="<?php echo $useragentthemesswitcher_settings['device5']['description']; ?>"></td>
							</tr>
							<tr>
								<td align="center" valign="middle">
								<select name="useragentthemesswitcher_selecttheme6">
								<?php
								foreach ($themes as $theme) {
									if ( $useragentthemesswitcher_settings['device6']['theme'] === $theme['Name'] ) {
									?>
										<option value="<?php echo $theme['Name']; ?>" selected><?php echo $theme['Name']; ?></option>
									<?php

									} else {
									?>
										<option value="<?php echo $theme['Name']; ?>"><?php echo $theme['Name']; ?></option>
									<?php
									}
								}
								?>
								</select>
								</td>
								<td align="center" valign="middle">
									<textarea name="useragentthemesswitcher_useragent6" rows="4" cols="60"><?php echo $useragentthemesswitcher_settings['device6']['useragent']; ?></textarea>
								</td>
								<td align="center" valign="middle"><input type="text" name="useragentthemesswitcher_description6" value="<?php echo $useragentthemesswitcher_settings['device6']['description']; ?>"></td>
							</tr>
							<tr>
								<td align="center" valign="middle">
								<select name="useragentthemesswitcher_selecttheme7">
								<?php
								foreach ($themes as $theme) {
									if ( $useragentthemesswitcher_settings['device7']['theme'] === $theme['Name'] ) {
									?>
										<option value="<?php echo $theme['Name']; ?>" selected><?php echo $theme['Name']; ?></option>
									<?php

									} else {
									?>
										<option value="<?php echo $theme['Name']; ?>"><?php echo $theme['Name']; ?></option>
									<?php
									}
								}
								?>
								</select>
								</td>
								<td align="center" valign="middle">
									<textarea name="useragentthemesswitcher_useragent7" rows="4" cols="60"><?php echo $useragentthemesswitcher_settings['device7']['useragent']; ?></textarea>
								</td>
								<td align="center" valign="middle"><input type="text" name="useragentthemesswitcher_description7" value="<?php echo $useragentthemesswitcher_settings['device7']['description']; ?>"></td>
							</tr>
						</tbody>
						</table>

						<p class="submit">
							<input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
						</p>
					</form>
			  		</div>
				</div>

				<!--
				<div id="tabs-2">
					<div class="wrap">
					<h2>FAQ</h2>
					</div>
		  		</div>
				-->
			</div>
		</div>
		<?php
	}


	/* ==================================================
	 * Update wp_options table.
	 * @since	1.0
	 */
	function options_updated(){

		$settings_tbl = array();

		if(isset($_POST['useragentthemesswitcher_selecttheme1'])){ $settings_tbl['device1']['theme'] = $_POST['useragentthemesswitcher_selecttheme1']; }
		if(isset($_POST['useragentthemesswitcher_selecttheme2'])){ $settings_tbl['device2']['theme'] = $_POST['useragentthemesswitcher_selecttheme2']; }
		if(isset($_POST['useragentthemesswitcher_selecttheme3'])){ $settings_tbl['device3']['theme'] = $_POST['useragentthemesswitcher_selecttheme3']; }
		if(isset($_POST['useragentthemesswitcher_selecttheme4'])){ $settings_tbl['device4']['theme'] = $_POST['useragentthemesswitcher_selecttheme4']; }
		if(isset($_POST['useragentthemesswitcher_selecttheme5'])){ $settings_tbl['device5']['theme'] = $_POST['useragentthemesswitcher_selecttheme5']; }
		if(isset($_POST['useragentthemesswitcher_selecttheme6'])){ $settings_tbl['device6']['theme'] = $_POST['useragentthemesswitcher_selecttheme6']; }
		if(isset($_POST['useragentthemesswitcher_selecttheme7'])){ $settings_tbl['device7']['theme'] = $_POST['useragentthemesswitcher_selecttheme7']; }

		if(isset($_POST['useragentthemesswitcher_useragent1'])){ $settings_tbl['device1']['useragent'] = stripslashes($_POST['useragentthemesswitcher_useragent1']); }
		if(isset($_POST['useragentthemesswitcher_useragent2'])){ $settings_tbl['device2']['useragent'] = stripslashes($_POST['useragentthemesswitcher_useragent2']); }
		if(isset($_POST['useragentthemesswitcher_useragent3'])){ $settings_tbl['device3']['useragent'] = stripslashes($_POST['useragentthemesswitcher_useragent3']); }
		if(isset($_POST['useragentthemesswitcher_useragent4'])){ $settings_tbl['device4']['useragent'] = stripslashes($_POST['useragentthemesswitcher_useragent4']); }
		if(isset($_POST['useragentthemesswitcher_useragent5'])){ $settings_tbl['device5']['useragent'] = stripslashes($_POST['useragentthemesswitcher_useragent5']); }
		if(isset($_POST['useragentthemesswitcher_useragent6'])){ $settings_tbl['device6']['useragent'] = stripslashes($_POST['useragentthemesswitcher_useragent6']); }
		if(isset($_POST['useragentthemesswitcher_useragent7'])){ $settings_tbl['device7']['useragent'] = stripslashes($_POST['useragentthemesswitcher_useragent7']); }

		if(isset($_POST['useragentthemesswitcher_description1'])){ $settings_tbl['device1']['description'] = $_POST['useragentthemesswitcher_description1']; }
		if(isset($_POST['useragentthemesswitcher_description2'])){ $settings_tbl['device2']['description'] = $_POST['useragentthemesswitcher_description2']; }
		if(isset($_POST['useragentthemesswitcher_description3'])){ $settings_tbl['device3']['description'] = $_POST['useragentthemesswitcher_description3']; }
		if(isset($_POST['useragentthemesswitcher_description4'])){ $settings_tbl['device4']['description'] = $_POST['useragentthemesswitcher_description4']; }
		if(isset($_POST['useragentthemesswitcher_description5'])){ $settings_tbl['device5']['description'] = $_POST['useragentthemesswitcher_description5']; }
		if(isset($_POST['useragentthemesswitcher_description6'])){ $settings_tbl['device6']['description'] = $_POST['useragentthemesswitcher_description6']; }
		if(isset($_POST['useragentthemesswitcher_description7'])){ $settings_tbl['device7']['description'] = $_POST['useragentthemesswitcher_description7']; }

		update_option( 'useragentthemesswitcher_settings', $settings_tbl );

	}
}

?>