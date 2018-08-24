<?php defined( 'ABSPATH' ) or exit; ?>
<div id="pl4wp-admin" class="wrap pl4wp-settings">

	<div class="row">

		<!-- Main Content -->
		<div class="main-content col col-4">

			<h1 class="page-title">
				<?php _e( "Add new form", 'phplist-for-wp' ); ?>
			</h1>

			<h2 style="display: none;"></h2><?php // fake h2 for admin notices ?>

			<div style="max-width: 480px;">

				<!-- Wrap entire page in <form> -->
				<form method="post">

					<input type="hidden" name="_pl4wp_action" value="add_form" />
					<?php wp_nonce_field( 'add_form', '_pl4wp_nonce' ); ?>


					<div class="small-margin">
						<h3>
							<label>
								<?php _e( 'What is the name of this form?', 'phplist-for-wp' ); ?>
							</label>
						</h3>
						<input type="text" name="pl4wp_form[name]" class="widefat" value="" spellcheck="true" autocomplete="off" placeholder="<?php _e( 'Enter your form title..', 'phplist-for-wp' ); ?>">
					</div>

					<div class="small-margin">

						<h3>
							<label>
								<?php _e( 'To which PhpList lists should this form subscribe?', 'phplist-for-wp' ); ?>
							</label>
						</h3>

						<?php if( ! empty( $lists ) ) { ?>
						<ul id="pl4wp-lists">
							<?php foreach( $lists as $list ) { ?>
								<li>
									<label>
										<input type="checkbox" name="pl4wp_form[settings][lists][<?php echo esc_attr( $list->id ); ?>]" value="<?php echo esc_attr( $list->id ); ?>" <?php checked( $number_of_lists, 1 ); ?> >
										<?php echo esc_html( $list->name ); ?>
									</label>
								</li>
							<?php } ?>
						</ul>
						<?php } else { ?>
						<p class="pl4wp-notice">
							<?php printf( __( 'No lists found. Did you <a href="%s">connect with PhpList</a>?', 'phplist-for-wp' ), admin_url( 'admin.php?page=phplist-for-wp' ) ); ?>
						</p>
						<?php } ?>

					</div>

					<?php submit_button( __( 'Add new form', 'phplist-for-wp' ) ); ?>


				</form><!-- Entire page form wrap -->

			</div>


			<?php include PL4WP_PLUGIN_DIR . 'includes/views/parts/admin-footer.php'; ?>

		</div><!-- / Main content -->

		<!-- Sidebar -->
		<div class="sidebar col col-2">
			<?php include PL4WP_PLUGIN_DIR . 'includes/views/parts/admin-sidebar.php'; ?>
		</div>


	</div>

</div>
