<?php

function WP_P_GT_P_interface()
{	
	require_once 'template/WP_P_GT_P_interface.php';
}

function WP_P_GT_P_request_handler()
{
	if(isset($_POST['submit_clear_cache']))
	{
		WP_P_GT_P_clear_cache();
		
		add_action('admin_notices', WP_P_GT_P_admin_notice('update', __('Cache deleted', 'wp-performance-gettext-patch')));

		/*
		add_action('admin_notices', function(){ 
				WP_P_GT_P_admin_notice('update', __('Cache deleted', 'wp-performance-gettext-patch')); 
		});
		*/
	}
	elseif(isset($_POST['submit_install']))
	{	
		if(true === $info = WP_P_GT_P_install())
			add_action('admin_notices', WP_P_GT_P_admin_notice('update', __('Installation successful', 'wp-performance-gettext-patch')));
		else
			add_action('admin_notices', WP_P_GT_P_admin_notice('error', $info));
		
		
		/*
		add_action('admin_notices', function(){
			if(true === $info = WP_P_GT_P_install())
				WP_P_GT_P_admin_notice('update', __('Installation successful', 'wp-performance-gettext-patch'));
			else
				WP_P_GT_P_admin_notice('error', $info);
		});
		*/
	}
	elseif(isset($_POST['submit_deinstall']))
	{
		if(true === $info = WP_P_GT_P_deinstall())
			add_action('admin_notices', WP_P_GT_P_admin_notice('update', __('Uninstall successful', 'wp-performance-gettext-patch')));
		else
			add_action('admin_notices', WP_P_GT_P_admin_notice('error', $info));
		
		/*
		add_action('admin_notices', function(){
			if(true === $info = WP_P_GT_P_deinstall())
				WP_P_GT_P_admin_notice('update', __('Uninstall successful', 'wp-performance-gettext-patch'));
			else
				WP_P_GT_P_admin_notice('error', $info);
		});
		*/
	}
	elseif(isset($_POST['submit_deactiv']))
	{
		if(WP_P_GT_P_patch_deactivate())
			add_action('admin_notices', WP_P_GT_P_admin_notice('update', __('Patch deactivated', 'wp-performance-gettext-patch')));
		else
			add_action('admin_notices', WP_P_GT_P_admin_notice('error', __('Patch is not installed', 'wp-performance-gettext-patch')));
		
		/*
		add_action('admin_notices', function(){
			if(WP_P_GT_P_patch_deactivate())
				WP_P_GT_P_admin_notice('update', __('Patch deactivated', 'wp-performance-gettext-patch'));
			else
				WP_P_GT_P_admin_notice('error', __('Patch is not installed', 'wp-performance-gettext-patch'));
		});
		*/
	}
	elseif(isset($_POST['submit_activ']))
	{
		
		if(WP_P_GT_P_patch_activate())
			add_action('admin_notices', WP_P_GT_P_admin_notice('update', __('Patch activated', 'wp-performance-gettext-patch')));
		else
			add_action('admin_notices', WP_P_GT_P_admin_notice('error', __('Patch is not installed', 'wp-performance-gettext-patch')));
		
		/*
		add_action('admin_notices', function(){
			if(WP_P_GT_P_patch_activate())
				WP_P_GT_P_admin_notice('update', __('Patch activated', 'wp-performance-gettext-patch'));
			else
				WP_P_GT_P_admin_notice('error', __('Patch is not installed', 'wp-performance-gettext-patch'));
		});
		*/
	}
	
	if(get_option('wp_p_gt_p_activ') && !is_writable(WP_P_GT_P_CACHE_DIR))
		add_action('admin_notices', WP_P_GT_P_admin_notice('error', __('Cache directory is not writable. Please grant your server write permissions to the directory:', 'wp-performance-gettext-patch').' '.WP_P_GT_P_CACHE_DIR));
	
	/*
	add_action('admin_notices', function(){
		if(get_option('wp_p_gt_p_activ') && !is_writable(WP_P_GT_P_CACHE_DIR))
			WP_P_GT_P_admin_notice('error', __('Cache directory is not writable. Please grant your server write permissions to the directory:', 'wp-performance-gettext-patch').' '.WP_P_GT_P_CACHE_DIR);
	});
	*/
}

function WP_P_GT_P_admin_notice($type, $msg)
{
	switch($type)
	{
		case 'update':
			echo '<div class="updated"><p><strong>'.$msg.'</strong></p></div>';
		break;
		
		case 'error':
			echo '<div class="error"><p><strong>'.$msg.'</strong></p></div>';
		break;
	}
}
?>