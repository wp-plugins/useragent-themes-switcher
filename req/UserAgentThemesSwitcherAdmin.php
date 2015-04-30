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
	 * Add Css and Script
	 * @since	1.4
	 */
	function load_custom_wp_admin_style() {
		wp_enqueue_style( 'jquery-responsiveTabs', USERAGENTTHEMESSWITCHER_PLUGIN_URL.'/css/responsive-tabs.css' );
		wp_enqueue_style( 'jquery-responsiveTabs-style', USERAGENTTHEMESSWITCHER_PLUGIN_URL.'/css/style.css' );
		wp_enqueue_script('jquery');
		wp_enqueue_script( 'jquery-responsiveTabs', USERAGENTTHEMESSWITCHER_PLUGIN_URL.'/js/jquery.responsiveTabs.min.js' );
	}

	/* ==================================================
	 * Add Script on footer
	 * @since	1.4
	 */
	function load_custom_wp_admin_style2() {
		echo $this->add_jscss();
	}

	/* ==================================================
	 * Settings page
	 * @since	1.0
	 */
	function plugin_options() {

		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}

		if( !empty($_POST) ) { 
			$this->options_updated();
		}

		$scriptname = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH).'?page=UserAgentThemesSwitcher';
		$useragentthemesswitcher_settings = get_option('useragentthemesswitcher_settings');
		$themes = wp_get_themes();

		?>
		<div class="wrap">
			<h2>UserAgent Themes Switcher</h2>
			<div id="useragentthemesswitcher-tabs">
				<ul>
				<li><a href="#useragentthemesswitcher-tabs-1"><?php _e('Settings'); ?></a></li>
				<li><a href="#useragentthemesswitcher-tabs-2"><?php _e('Donate to this plugin &#187;'); ?></a></li>
				<!--
				<li><a href="#useragentthemesswitcher-tabs-3">FAQ</a></li>
				 -->
				</ul>
				<div id="useragentthemesswitcher-tabs-1">
					<div class="wrap">
					<form method="post" action="<?php echo $scriptname; ?>">
						<h2><?php _e('Settings of user agent and theme', 'useragentthemesswitcher') ?></h2>

						<div class="submit">
							<input type="submit" name="Submit" class="button-primary button-large" value="<?php _e('Save Changes') ?>" />
						</div>

						<div style="padding: 10px; border: #CCC 2px solid; margin: 0 0 20px 0; width: 260px; float: left;">
							<div style="display: block;">
							<?php _e('Device', 'useragentthemesswitcher'); ?>1
							</div>
							<div style="display: block; padding: 20px 0;">
							<?php _e('Themes'); ?>
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
							</div>
							<div>
							<?php _e('User Agent[Regular expression is possible.]', 'useragentthemesswitcher'); ?>
							</div>
							<div>
							<textarea name="useragentthemesswitcher_useragent1" rows="4" style="width: 100%;"><?php echo $useragentthemesswitcher_settings['device1']['useragent']; ?></textarea>
							</div>
							<div style="display:block;padding:20px 0">
							<?php _e('Description'); ?>
							<input type="text" name="useragentthemesswitcher_description1" value="<?php echo $useragentthemesswitcher_settings['device1']['description']; ?>">
							</div>
						</div>

						<div style="padding: 10px; border: #CCC 2px solid; margin: 0 0 20px 0; width: 260px; float: left;">
							<div style="display: block;">
							<?php _e('Device', 'useragentthemesswitcher'); ?>2
							</div>
							<div style="display: block; padding: 20px 0;">
							<?php _e('Themes'); ?>
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
							</div>
							<div>
							<?php _e('User Agent[Regular expression is possible.]', 'useragentthemesswitcher'); ?>
							</div>
							<div>
							<textarea name="useragentthemesswitcher_useragent2" rows="4" style="width: 100%;"><?php echo $useragentthemesswitcher_settings['device2']['useragent']; ?></textarea>
							</div>
							<div style="display:block;padding:20px 0">
							<?php _e('Description'); ?>
							<input type="text" name="useragentthemesswitcher_description2" value="<?php echo $useragentthemesswitcher_settings['device2']['description']; ?>">
							</div>
						</div>

						<div style="padding: 10px; border: #CCC 2px solid; margin: 0 0 20px 0; width: 260px; float: left;">
							<div style="display: block;">
							<?php _e('Device', 'useragentthemesswitcher'); ?>3
							</div>
							<div style="display: block; padding: 20px 0;">
							<?php _e('Themes'); ?>
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
							</div>
							<div>
							<?php _e('User Agent[Regular expression is possible.]', 'useragentthemesswitcher'); ?>
							</div>
							<div>
							<textarea name="useragentthemesswitcher_useragent3" rows="4" style="width: 100%;"><?php echo $useragentthemesswitcher_settings['device3']['useragent']; ?></textarea>
							</div>
							<div style="display:block;padding:20px 0">
							<?php _e('Description'); ?>
							<input type="text" name="useragentthemesswitcher_description3" value="<?php echo $useragentthemesswitcher_settings['device3']['description']; ?>">
							</div>
						</div>

						<div style="padding: 10px; border: #CCC 2px solid; margin: 0 0 20px 0; width: 260px; float: left;">
							<div style="display: block;">
							<?php _e('Device', 'useragentthemesswitcher'); ?>4
							</div>
							<div style="display: block; padding: 20px 0;">
							<?php _e('Themes'); ?>
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
							</div>
							<div>
							<?php _e('User Agent[Regular expression is possible.]', 'useragentthemesswitcher'); ?>
							</div>
							<div>
							<textarea name="useragentthemesswitcher_useragent4" rows="4" style="width: 100%;"><?php echo $useragentthemesswitcher_settings['device4']['useragent']; ?></textarea>
							</div>
							<div style="display:block;padding:20px 0">
							<?php _e('Description'); ?>
							<input type="text" name="useragentthemesswitcher_description4" value="<?php echo $useragentthemesswitcher_settings['device4']['description']; ?>">
							</div>
						</div>

						<div style="padding: 10px; border: #CCC 2px solid; margin: 0 0 20px 0; width: 260px; float: left;">
							<div style="display: block;">
							<?php _e('Device', 'useragentthemesswitcher'); ?>5
							</div>
							<div style="display: block; padding: 20px 0;">
							<?php _e('Themes'); ?>
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
							</div>
							<div>
							<?php _e('User Agent[Regular expression is possible.]', 'useragentthemesswitcher'); ?>
							</div>
							<div>
							<textarea name="useragentthemesswitcher_useragent5" rows="4" style="width: 100%;"><?php echo $useragentthemesswitcher_settings['device5']['useragent']; ?></textarea>
							</div>
							<div style="display:block;padding:20px 0">
							<?php _e('Description'); ?>
							<input type="text" name="useragentthemesswitcher_description5" value="<?php echo $useragentthemesswitcher_settings['device5']['description']; ?>">
							</div>
						</div>

						<div style="padding: 10px; border: #CCC 2px solid; margin: 0 0 20px 0; width: 260px; float: left;">
							<div style="display: block;">
							<?php _e('Device', 'useragentthemesswitcher'); ?>6
							</div>
							<div style="display: block; padding: 20px 0;">
							<?php _e('Themes'); ?>
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
							</div>
							<div>
							<?php _e('User Agent[Regular expression is possible.]', 'useragentthemesswitcher'); ?>
							</div>
							<div>
							<textarea name="useragentthemesswitcher_useragent6" rows="4" style="width: 100%;"><?php echo $useragentthemesswitcher_settings['device6']['useragent']; ?></textarea>
							</div>
							<div style="display:block;padding:20px 0">
							<?php _e('Description'); ?>
							<input type="text" name="useragentthemesswitcher_description6" value="<?php echo $useragentthemesswitcher_settings['device6']['description']; ?>">
							</div>
						</div>

						<div style="padding: 10px; border: #CCC 2px solid; margin: 0 0 20px 0; width: 260px; float: left;">
							<div style="display: block;">
							<?php _e('Device', 'useragentthemesswitcher'); ?>7
							</div>
							<div style="display: block; padding: 20px 0;">
							<?php _e('Themes'); ?>
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
							</div>
							<div>
							<?php _e('User Agent[Regular expression is possible.]', 'useragentthemesswitcher'); ?>
							</div>
							<div>
							<textarea name="useragentthemesswitcher_useragent7" rows="4" style="width: 100%;"><?php echo $useragentthemesswitcher_settings['device7']['useragent']; ?></textarea>
							</div>
							<div style="display:block;padding:20px 0">
							<?php _e('Description'); ?>
							<input type="text" name="useragentthemesswitcher_description7" value="<?php echo $useragentthemesswitcher_settings['device7']['description']; ?>">
							</div>
						</div>

						<div style="clear:both"></div>

						<div class="submit">
							<input type="submit" name="Submit" class="button-primary button-large" value="<?php _e('Save Changes') ?>" />
						</div>

					</form>
			  		</div>
		  		</div>

				<div id="useragentthemesswitcher-tabs-2">
				<div class="wrap">
					<h3><?php _e('Please make a donation if you like my work or would like to further the development of this plugin.', 'useragentthemesswitcher'); ?></h3>
					<div align="right">Katsushi Kawamori</div>
					<h3 style="float: left;"><?php _e('Donate to this plugin &#187;'); ?></h3>
		<a href='https://pledgie.com/campaigns/28307' target="_blank"><img alt='Click here to lend your support to: Various Plugins for WordPress and make a donation at pledgie.com !' src='https://pledgie.com/campaigns/28307.png?skin_name=chrome' border='0' ></a>
				</div>
				</div>

				<!--
				<div id="useragentthemesswitcher-tabs-3">
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
		echo '<div class="updated"><ul><li>'.__('Settings saved.').'</li></ul></div>';

	}

	/* ==================================================
	 * Add js css
	 * @since	1.4
	 */
	function add_jscss(){

// JS
$useragentthemesswitcher_add_jscss = <<<USERAGENTTHEMESSWITCHER

<!-- BEGIN: UserAgent Themes Switcher -->
<script type="text/javascript">
jQuery('#useragentthemesswitcher-tabs').responsiveTabs({
  startCollapsed: 'accordion'
});
</script>
<!-- END: UserAgent Themes Switcher -->

USERAGENTTHEMESSWITCHER;

		return $useragentthemesswitcher_add_jscss;

	}

}

?>