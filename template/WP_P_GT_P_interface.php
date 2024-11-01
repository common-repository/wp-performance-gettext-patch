<div class="wrap">
<div class="icon32" id="icon-options-general">
<br>
</div>
<h2><?php echo __('All Settings'); ?> › <?php echo __('WP Performance Gettext Patch', 'wp-performance-gettext-patch'); ?></h2>
	
	<h3><?php echo __('Overview' , 'wp-performance-gettext-patch'); ?></h3>
	<form method="post">
		<table class="form-table">
			<tr>
				<th><?php echo __('Gettext Native-Lib', 'wp-performance-gettext-patch'); ?>:</th>
				<td>
					<?php 
						if(WP_P_GT_P_NATIV_LIB)
							echo '<span style="color: #008000;">'.__('Available', 'wp-performance-gettext-patch').'</span>';
						else
							echo '<span style="color: #008000;">'.__('Not available', 'wp-performance-gettext-patch').'</span>';
					?>
				</td>
			</tr>
			<tr>
				<th><?php echo __('Perfomance Patch', 'wp-performance-gettext-patch'); ?>:</th>
				<td>
					<?php 
						if(WP_P_GT_P_INSTALL && get_option('wp_p_gt_p_activ', false))
							echo '<span style="color: #008000;">'.__('Active', 'wp-performance-gettext-patch').'</span>';
						else
						{
							echo '<span style="color: #ff0000;">'.__('Inactive', 'wp-performance-gettext-patch').'</span> ';
							echo '<span class="description">'.((WP_P_GT_P_INSTALL) ? '' : __('(patch is not installed)', 'wp-performance-gettext-patch')).'</span>';
						}
					?>					
				</td>
			</tr>
			<tr>
				<th><?php echo __('Patch version', 'wp-performance-gettext-patch'); ?>:</th>
				<td><?php echo WP_P_GT_P_VER; ?></td>
			</tr>
		</table>
	</form>
	<h3><?php echo __('Settings', 'wp-performance-gettext-patch'); ?></h3>
	<form method="post">
		<table class="form-table">
			<tr>
				<th><?php echo __('Patch', 'wp-performance-gettext-patch'); ?>:</th>
				<td>
					<?php 
						if(get_option('wp_p_gt_p_activ', false))
							echo '<input type="submit" name="submit_deactiv" value="'.__('Deactivate', 'wp-performance-gettext-patch').'">';
						else
							echo '<input type="submit" name="submit_activ" value="'.__('Activate', 'wp-performance-gettext-patch').'">';
					?>
				</td>
			</tr>
			<tr>
				<th><?php echo __('Delete cache', 'wp-performance-gettext-patch'); ?>:</th>
				<td><input type="submit" name="submit_clear_cache" value="<?php echo __('Delete cache', 'wp-performance-gettext-patch'); ?>"><span class="description"> <?php echo __('(cache will be deleted automatically during updates/upgrades of the plugins, themes or WP)', 'wp-performance-gettext-patch'); ?></span></td>
			</tr>
		</table>
	</form>
	<h3><?php echo __('Install & Uninstall', 'wp-performance-gettext-patch'); ?></h3>
	<form method="post">
		<table class="form-table">
			<tr>
				<th><?php echo __('Install', 'wp-performance-gettext-patch'); ?>:</th>
				<td>
					<input type="submit" name="submit_install" value="<?php echo __('Install the patch', 'wp-performance-gettext-patch'); ?>">
					
					<p>
						<b><?php echo __('Note', 'wp-performance-gettext-patch'); ?>:</b><br> 
						<?php echo __('Following folders and files must have write permission', 'wp-performance-gettext-patch'); ?>: <br>
					 	*<b> <?php echo realpath(WP_P_GT_P_CACHE_DIR); ?></b> <?php echo __('(755) permanent', 'wp-performance-gettext-patch'); ?> <br>
					 	*<b> <?php echo realpath(ABSPATH.'/wp-includes/l10n.php'); ?></b> <?php echo __('(655) only during the installation ', 'wp-performance-gettext-patch'); ?>
				 	</p>
				</td>
			</tr>
			<tr>
				<th><?php echo __('Uninstall', 'wp-performance-gettext-patch'); ?>:</th>
				<td>
					<input type="submit" name="submit_deinstall" value="<?php echo __('Uninstall the patch', 'wp-performance-gettext-patch'); ?>">
					<p>
						<b><?php echo __('Note', 'wp-performance-gettext-patch'); ?>:</b><br> 
						<?php echo __('Following folders and files must have write permission', 'wp-performance-gettext-patch'); ?>: <br>
					 	*<b> <?php echo realpath(ABSPATH.'/wp-includes/l10n.php'); ?></b> <?php echo __('(655) only during the uninstall', 'wp-performance-gettext-patch'); ?>
				 	</p>
				</td>
			</tr>
		</table>
	</form>
</div>