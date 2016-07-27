<?php
/**
 * Primary Menu Template
 *
 * Displays the Primary Menu if it has active menu items.
 *
 * @package sonorous
 * @subpackage Template
 */
 
if ( has_nav_menu( 'primary' ) ) : ?>

	<?php do_atomic( 'before_menu_primary' ); // sonorous_before_menu_primary ?>

	<nav id="menu-primary" class="menu-container">
		
		<h3 id="menu-primary-title">
			<?php _e( 'Toggle Menu', 'sonorous' ); ?>
		</h3><!-- #menu-primary-title -->

		<?php do_atomic( 'open_menu_primary' ); // sonorous_open_menu_primary ?>

		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'menu', 'menu_class' => '', 'menu_id' => 'menu-primary-items', 'fallback_cb' => '' ) ); ?>

		<?php do_atomic( 'close_menu_primary' ); // sonorous_close_menu_primary ?>

	</nav><!-- #menu-primary .menu-container -->

	<?php do_atomic( 'after_menu_primary' ); // sonorous_after_menu_primary ?>

<?php endif; ?>