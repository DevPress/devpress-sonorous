<?php
/**
 * Secondary Menu Template
 *
 * Displays the Secondary Menu if it has active menu items.
 *
 * @package sonorous
 * @subpackage Template
 */

if ( has_nav_menu( 'secondary' ) ) : ?>

	<?php do_atomic( 'before_menu_secondary' ); // sonorous_before_menu_secondary ?>

	<nav id="menu-secondary" class="menu-container">

		<div class="wrap">

			<?php do_atomic( 'open_menu_secondary' ); // sonorous_open_menu_secondary ?>

			<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'container_class' => 'menu', 'menu_class' => '', 'menu_id' => 'menu-secondary-items', 'fallback_cb' => '' ) ); ?>

			<?php do_atomic( 'close_menu_secondary' ); // sonorous_close_menu_secondary ?>

		</div><!-- .wrap -->

	</nav><!-- #menu-secondary .menu-container -->

	<?php do_atomic( 'after_menu_secondary' ); // sonorous_after_menu_secondary ?>

<?php endif; ?>