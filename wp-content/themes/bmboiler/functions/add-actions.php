<?php

$user = wp_get_current_user();
// If sparxoo admin, add custom wpadminbar nodes
if ($user->ID === 1) {
	
	add_action( 'admin_bar_menu', 'xoo_custom_adminbar_nodes', 999 );
	function xoo_custom_adminbar_nodes( $wp_admin_bar ) {

		// Top level for dropdown
		$wp_admin_bar->add_node(array(
			'id' => 'xoo-custom-nodes', // ID
			'title' => 'Xoo Admin', // Link content
			'meta' => array(
				'class' => 'xoo-custom-nodes'
			), // meta
		));

		$wp_admin_bar->add_node(array(
			'id' => 'xoo-custom-fields',
			'title' => 'ACF Groups',
			'parent' => 'xoo-custom-nodes',
			'href' => admin_url() . 'edit.php?post_type=acf-field-group',
			'meta' => array(
				'class' => 'xoo-custom-fields'
			)
		));

		$wp_admin_bar->add_node(array(
			'id' => 'xoo-custom-fields-add',
			'title' => 'Add Group',
			'parent' => 'xoo-custom-fields',
			'href' => admin_url() . 'post-new.php?post_type=acf-field-group',
			'meta' => array(
				'class' => 'xoo-custom-fields-add'
			)
		));

		$wp_admin_bar->add_node(array(
			'id' => 'xoo-menus',
			'title' => 'Menus',
			'parent' => 'xoo-custom-nodes',
			'href' => admin_url() . 'nav-menus.php',
			'meta' => array(
				'class' => 'xoo-menus'
			)
		));

		$wp_admin_bar->add_node(array(
			'id' => 'xoo-menus-add',
			'title' => 'Add Menu',
			'parent' => 'xoo-menus',
			'href' => admin_url() . 'nav-menus.php?action=edit&menu=0',
			'meta' => array(
				'class' => 'xoo-menus-add'
			)
		));

		$wp_admin_bar->add_node(array(
			'id' => 'xoo-plugins',
			'title' => 'Plugins',
			'parent' => 'xoo-custom-nodes',
			'href' => admin_url() . 'plugins.php',
			'meta' => array(
				'class' => 'xoo-plugins'
			)
		));

		$wp_admin_bar->add_node(array(
			'id' => 'xoo-plugins-add',
			'title' => 'Add Plugin',
			'parent' => 'xoo-plugins',
			'href' => admin_url() . 'plugin-install.php',
			'meta' => array(
				'class' => 'xoo-plugins-add'
			)
		));

		$wp_admin_bar->add_node(array(
			'id' => 'xoo-media',
			'title' => 'Media',
			'parent' => 'xoo-custom-nodes',
			'href' => admin_url() . 'upload.php',
			'meta' => array(
				'class' => 'xoo-media'
			)
		));

		$wp_admin_bar->add_node(array(
			'id' => 'xoo-media-add',
			'title' => 'Add Media',
			'parent' => 'xoo-media',
			'href' => admin_url() . 'media-new.php',
			'meta' => array(
				'class' => 'xoo-media-add'
			)
		));

		$wp_admin_bar->add_node(array(
			'id' => 'xoo-forms',
			'title' => 'Gravity Forms',
			'parent' => 'xoo-custom-nodes',
			'href' => admin_url() . 'admin.php?page=gf_edit_forms',
			'meta' => array(
				'class' => 'xoo-forms'
			)
		));

		$wp_admin_bar->add_node(array(
			'id' => 'xoo-forms-add',
			'title' => 'Add Form',
			'parent' => 'xoo-forms',
			'href' => admin_url() . 'admin.php?page=gf_new_form',
			'meta' => array(
				'class' => 'xoo-forms-add'
			)
		));

		$wp_admin_bar->add_node(array(
			'id' => 'xoo-pages',
			'title' => 'Pages',
			'parent' => 'xoo-custom-nodes',
			'href' => admin_url() . 'edit.php?post_type=page',
			'meta' => array(
				'class' => 'xoo-pages'
			)
		));

		$wp_admin_bar->add_node(array(
			'id' => 'xoo-pages-add',
			'title' => 'Add Page',
			'parent' => 'xoo-pages',
			'href' => admin_url() . 'post-new.php?post_type=page',
			'meta' => array(
				'class' => 'xoo-pages-add'
			)
		));

		$wp_admin_bar->add_node(array(
			'id' => 'xoo-migrate',
			'title' => 'WP Migrate DB',
			'parent' => 'xoo-custom-nodes',
			'href' => admin_url() . 'tools.php?page=wp-migrate-db-pro',
			'meta' => array(
				'class' => 'xoo-migrate'
			)
		));

		$wp_admin_bar->add_node(array(
			'id' => 'xoo-updates',
			'title' => 'Site Updates',
			'parent' => 'xoo-custom-nodes',
			'href' => admin_url() . 'update-core.php',
			'meta' => array(
				'class' => 'xoo-updates'
			)
		));

	}

}

// Add plugin warning options
add_option('spx_plugin_notice_dismissed', 'not_dismissed');
add_option('spx_plugin_warning_dismissed', '2018-11-01 00:00:00');

// Add plugin warning notices
function plugin_notices() {

	global $pagenow;

	if($pagenow === 'plugins.php' || $pagenow === 'plugin-install.php') : ?>

		<?php
		$num_plugins = count(get_option('_transient_plugin_slugs'));
		$active_plugins = count(get_option('active_plugins'));
		$notice_threshold = 18;
		$warning_threshold = 24;

		$datetimenow = new DateTime();
		$warning_dismissed = DateTime::createFromFormat('Y-m-d H:i:s', get_option('spx_plugin_warning_dismissed'));
		if ($warning_dismissed !== false) {
			$diff = $datetimenow->diff($warning_dismissed, false);
		}
		$notice_dismissed = get_option('spx_plugin_notice_dismissed');
		?>

		<?php if ( $active_plugins >= $notice_threshold ) : ?>

			<?php if( $notice_dismissed === 'not_dismissed' ) : ?>

				<div id="spx_plugin_notice" class="notice notice-warning is-dismissible">
					<h2>Sparxoo: Plugin Overhead Notice</h2>
					<p>The site currently has <strong><?php echo $num_plugins ?></strong> plugins installed and <strong><?php echo $active_plugins ?></strong> plugins active.</p>
					<p>As more plugins get added to the site, its performance will be affected. The current number of active plugins is okay for now, but we recommend keeping the number of active plugins under <strong><?php echo $warning_threshold ?></strong> for stability purposes.</p>
					<p>If the number of active plugins exceeds this number, it may become impossible to make significant updates to the site. <strong>For example</strong>: Editing template functionality, updating WordPress or plugins, or migrating to another server.</p>
					<p><a href="#" class="dismiss">Dismiss permanently</a></p>
					<script type="text/javascript">
						jQuery(document).ready(function($) {
							var admin_ajax = '<?php echo admin_url('admin-ajax.php') ?>';
							$('.dismiss').click(function(e) {
								e.preventDefault();

								$.ajax({
									url: admin_ajax,
									type: 'POST',
									data: {
										action: 'spx_update_option',
										key: 'spx_plugin_notice_dismissed',
										value: 'dismissed'
									},
									success: function(res) {

										if (res === 'true') {
											$('#spx_plugin_notice').remove();
										}
									},
									error: function(res) {

									}
								});
							});
						});
					</script>
				</div>

			<?php endif; ?>

			<?php elseif ( $active_plugins >= $warning_threshold && !empty($diff) ) : ?>

				<?php if( $diff->y > 0 || $diff->m > 0 || $diff->d > 6 ) : ?>

					<div id="spx_plugin_warning" class="notice notice-error">
						<h2>Sparxoo: Plugin Overhead Warning</h2>
						<p>The site currently has <strong><?php echo $num_plugins ?></strong> plugins installed and <strong><?php echo $active_plugins ?></strong> plugins active.</p>
						<p>This is above the recommended number of active plugins, and will cause noticable performance decline, especially in the WordPress admin. Additionally, the following issues may be incurred:</p>
						<ul style="list-style: disc; padding-left: 2em;">
							<li>Inability to safely update WordPress</li>
							<li>Inability to safely update Plugins</li>
							<li>Inability to safely update template funcitonality</li>
							<li>Inability to migrate site to other servers</li>
							<li>Chance of site crashing when interacting with certain plugins</li>
						</ul>
						<p><a href="#" class="postpone">Dismiss for 1 week</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="dismiss" style="color: #dc3232;">Dismiss permanently</a></p>
						<script type="text/javascript">
							jQuery(document).ready(function($) {
								var admin_ajax = '<?php echo admin_url('admin-ajax.php') ?>';

								$('.postpone').click(function(e) {
									e.preventDefault();

									$.ajax({
										url: admin_ajax,
										type: 'POST',
										data: {
											action: 'spx_update_option',
											key: 'spx_plugin_warning_dismissed',
											value: '<?php echo $datetimenow->format('Y-m-d H:i:s') ?>'
										},
										success: function(res) {

											if (res === 'true') {
												$('#spx_plugin_warning').remove();
											}
										},
										error: function(res) {

										}
									});
								});

								$('.dismiss').click(function(e) {
									e.preventDefault();

									$.ajax({
										url: admin_ajax,
										type: 'POST',
										data: {
											action: 'spx_update_option',
											key: 'spx_plugin_warning_dismissed',
											value: 'dismissed'
										},
										success: function(res) {

											if (res === 'true') {
												$('#spx_plugin_warning').remove();
											}
										},
										error: function(res) {

										}
									});
								});
							});
						</script>
					</div>

				<?php endif; ?>

			<?php endif; ?>

		<?php endif;

	}

	add_action('set_current_user', 'cc_hide_admin_bar');
	function cc_hide_admin_bar() {
		if (!current_user_can('edit_posts')) {
			show_admin_bar(false);
		}
	}

	add_action( 'wp_login_failed', 'my_front_end_login_fail' );  // hook failed login
	function my_front_end_login_fail( $username ) {
		$referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?
		// if there's a valid referrer, and it's not the default log-in screen
		if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
			wp_redirect( $referrer . '&login=failed' );  // let's append some information (login=failed) to the URL for the theme to use
			exit;
		}
	}

	// add_action('acf/save_post', 'custom_acf_save_post', 20);
	// function custom_acf_save_post( $post_id ) {
	// 	// bail early if no ACF data
	// 	if( empty($_POST['acf']) ) {
	// 		return;
	// 	} elseif ($_POST['acf']){
	// 		if(get_post_type($post_id) == 'tribute'){
	// 			$data['ID'] = $post_id;
	// 			// Combine first name and last name to create a title
	// 			$title = trim($_POST['acf']['field_59f0a5c21cc67']) . " " . trim($_POST['acf']['field_59f0a5d51cc68']);
	// 			$data['post_title'] = $title;
	// 			$data['post_name'] = sanitize_title( $title );
	// 			wp_update_post( $data );
	// 		}
	// 	}
	// }

	?>