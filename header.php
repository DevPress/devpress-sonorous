<?php
/**
 * Header Template
 *
 * The header template is generally used on every page of your site. Nearly all other templates call it
 * somewhere near the top of the file. It is used mostly as an opening wrapper, which is closed with the
 * footer.php file. It also executes key functions needed by the theme, child themes, and plugins.
 *
 * @package sonorous
 * @subpackage Template
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="all" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); // wp_head ?>
</head>

<body class="<?php hybrid_body_class(); ?>">

	<?php do_atomic( 'open_body' ); // sonorous_open_body ?>

	<div id="container">

		<?php do_atomic( 'before_header' ); // sonorous_before_header ?>

		<header id="header">

			<?php do_atomic( 'open_header' ); // sonorous_open_header ?>

			<?php if ( hybrid_get_setting( 'sonorous_logo_url' ) ) : ?>

				<h1 id="site-title">
					<a href="<?php echo home_url(); ?>/" title="<?php echo bloginfo( 'name' ); ?>" rel="Home">
						<img class="logo" src="<?php echo hybrid_get_setting( 'sonorous_logo_url' ); ?>" alt="<?php echo bloginfo( 'name' ); ?>" />
					</a>
				</h1>

			<?php else : ?>

				<h1 id="site-title"><a href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>

			<?php endif; ?>

			<?php get_template_part( 'menu', 'primary' ); // Loads the menu-primary.php template. ?>

			<?php get_search_form(); ?>

			<?php if( !is_user_logged_in() ) : ?><a class="login-link"><?php _e( 'Login', 'sonorous' ); ?></a><?php endif; ?>

			<?php do_atomic( 'close_header' ); // sonorous_close_header ?>

		</header><!-- #header -->

		<?php if( !is_user_logged_in() ) : ?>

		<div id="sonorous-loginform">
			<?php

				$args = array(
					'echo' => true,
					'redirect' => site_url( $_SERVER['REQUEST_URI'] ),
					'form_id' => 'loginform',
					'label_username' => __( 'Username', 'sonorous' ),
					'label_password' => __( 'Password', 'sonorous' ),
					'label_remember' => __( 'Remember Me', 'sonorous' ),
					'label_log_in' => __( 'Log In', 'sonorous' ),
					'id_username' => 'sonorous-user_login',
					'id_password' => 'sonorous-user_pass',
					'id_remember' => 'sonorous-rememberme',
					'id_submit' => 'sonorous-wp-submit',
					'remember' => true,
					'value_username' => NULL,
					'value_remember' => false );

				wp_login_form( $args );

			?>
		</div><!-- #sonorous-loginform -->

		<?php endif; ?>

		<?php do_atomic( 'before_main' ); // sonorous_before_main ?>

		<div id="main">

			<?php do_atomic( 'open_main' ); // sonorous_open_main ?>