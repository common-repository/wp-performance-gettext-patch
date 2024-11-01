<?php
/*
Plugin Name: WP-Performance-Gettext-Patch
Plugin URI: http://wordpress.org/extend/plugins/wp-performance-gettext-patch/
Description: This plugin (patch) implements the native php gettext lib in Wordpress. This accelerates Wordpress extremely. Take a look at benchmarks.
Version: 0.11
Author: Julius Fischer
Author URI: http://www.it-gecko.de
*/

define('WP_P_GT_P_PLUGIN_DIR', WP_PLUGIN_DIR.'/wp-performance-gettext-patch/');
define('WP_P_GT_P_l10n_FILE', realpath(ABSPATH.'/wp-includes/l10n.php'));
define('WP_P_GT_P_VER', '0.11');

if(!defined('WP_P_GT_P_CACHE_DIR'))
	define('WP_P_GT_P_CACHE_DIR', WP_P_GT_P_PLUGIN_DIR.'wp-lang/');

if(!defined('WP_P_GT_P_INSTALL'))
	define('WP_P_GT_P_INSTALL', false);

if(function_exists("dgettext"))
	define('WP_P_GT_P_NATIV_LIB', true);
else
	define('WP_P_GT_P_NATIV_LIB', false);

function WP_P_GT_P_set_new_cachetime()
{
	update_option('wp_p_gt_cachetime', time());
}

function WP_P_GT_P_clear_cache($dir = WP_P_GT_P_CACHE_DIR)
{
	$list = array_diff(scandir($dir), array('.', '..'));
	
	foreach ($list as $value)
	{
		$file = $dir.'/'.$value;
		if (is_dir($file)) 
			WP_P_GT_P_clear_cache($file); 
		else
			unlink($file);
	}
	
	WP_P_GT_P_set_new_cachetime();
}

function WP_P_GT_P_admin_menu()
{
	require_once 'interface.php';

	$options_page = add_options_page('WP-Gettext-Patch', 'WP Performance Patch', 'manage_options', 'wp-performance-gettext-patch', 'WP_P_GT_P_interface');
	
	add_action('admin_head-'.$options_page, 'WP_P_GT_P_request_handler');
}

function WP_P_GT_P_install()
{
	if(WP_P_GT_P_INSTALL)
		return __('Patch is already installed', 'wp-performance-gettext-patch');
	
	if(!function_exists('dgettext'))
		return __('The native Gettext Lib is not available on your system', 'wp-performance-gettext-patch');
	
	if(!is_writable(WP_P_GT_P_CACHE_DIR))
		return __('Cache directory is not writable. Please grant your server write permissions to the directory:', 'wp-performance-gettext-patch').' '.WP_P_GT_P_CACHE_DIR;
	
	if(!is_writable(WP_P_GT_P_l10n_FILE))
		return __('l10n file is not writable. Please grant your server write permissions to the file:', 'wp-performance-gettext-patch').' '.WP_P_GT_P_l10n_FILE;
	
	if(false === $l10n = file_get_contents(WP_P_GT_P_l10n_FILE))
		return WP_P_GT_P_l10n_FILE.' '.__('Can not read', 'wp-performance-gettext-patch');
	
	if(false === file_put_contents(WP_P_GT_P_l10n_FILE, 
		'<?php define("WP_P_GT_P_INSTALL", true); if(get_option("wp_p_gt_p_activ") && 
				file_exists(ABSPATH."/wp-content/plugins/wp-performance-gettext-patch/l10n_lib.php")) {
require_once ABSPATH."/wp-content/plugins/wp-performance-gettext-patch/l10n_lib.php"; }else{ /*'.$l10n.' }'))
		return WP_P_GT_P_l10n_FILE.' '.__('Can not write', 'wp-performance-gettext-patch');

	
	add_option('wp_p_gt_cachetime', time(), '', 'yes');
	add_option('wp_p_gt_p_activ', true, '', 'yes');
	
	WP_P_GT_P_clear_cache();
	
	return true;
	
}

function WP_P_GT_P_deinstall()
{
	if(!WP_P_GT_P_INSTALL)
		return __('Patch is already installed', 'wp-performance-gettext-patch');
	
	if(!is_writable(WP_P_GT_P_CACHE_DIR))
		return __('Cache directory is not writable. Please grant your server write permissions to the directory:', 'wp-performance-gettext-patch').' '.WP_P_GT_P_CACHE_DIR;

	if(!is_writable(WP_P_GT_P_l10n_FILE))
		return __('l10n file is not writable. Please grant your server write permissions to the file:', 'wp-performance-gettext-patch').' '.WP_P_GT_P_l10n_FILE;

	if(false === $l10n = file_get_contents(WP_P_GT_P_l10n_FILE))
		return WP_P_GT_P_l10n_FILE.' '.__('Can not read', 'wp-performance-gettext-patch');
	
	$len = strlen('<?php define("WP_P_GT_P_INSTALL", true); if(get_option("wp_p_gt_p_activ") && 
				file_exists(ABSPATH."/wp-content/plugins/wp-performance-gettext-patch/l10n_lib.php")) {
require_once ABSPATH."/wp-content/plugins/wp-performance-gettext-patch/l10n_lib.php"; }else{ /*');
	
	if(false === file_put_contents(WP_P_GT_P_l10n_FILE,  substr($l10n, $len, -2)))
		return WP_P_GT_P_l10n_FILE.' '.__('Can not write', 'wp-performance-gettext-patch');

	WP_P_GT_P_clear_cache();

	delete_option('wp_p_gt_cachetime');
	delete_option('wp_p_gt_p_activ');

	return true;
}

function WP_P_GT_P_patch_activate()
{
	if(WP_P_GT_P_INSTALL)
	{
		update_option('wp_p_gt_p_activ', true);
		
		return true;
	}
	
	return false;
	
}

function WP_P_GT_P_patch_deactivate()
{
	if(WP_P_GT_P_INSTALL)
	{
		update_option('wp_p_gt_p_activ', false);

		return true;
	}

	return false;

}

function WP_P_GT_P_updates($install_actions = null)
{
	WP_P_GT_P_clear_cache();
		
	return $install_actions;
}

load_plugin_textdomain('wp-performance-gettext-patch', false, basename(dirname(__FILE__)).'/languages');

add_filter('update_plugin_complete_actions', 'WP_P_GT_P_updates');
add_filter('update_theme_complete_actions', 'WP_P_GT_P_updates');
add_filter('install_theme_complete_actions', 'WP_P_GT_P_updates');
add_filter('install_plugin_complete_actions', 'WP_P_GT_P_updates');

add_action('_core_updated_successfully', 'WP_P_GT_P_updates');


add_action('admin_menu', 'WP_P_GT_P_admin_menu');
?>