<?php
/**
 * Footer Template
 *
 * The footer template is generally used on every page of your site. Nearly all other templates call it somewhere near the bottom of the file. It is used mostly as a closing wrapper, which is opened with the header.php file. It also executes key functions needed by the theme, child themes, and plugins. 
 *
 * @package sonorous
 * @subpackage Template
 */
?>

			<?php get_sidebar( 'primary' ); // Loads the sidebar-primary.php template ?>

			<?php do_atomic( 'close_main' ); // sonorous_close_main ?>

		</div><!-- #main -->
			
		<?php do_atomic( 'after_main' ); // sonorous_after_main ?>
		
		<footer id="footer">

			<?php do_atomic( 'open_footer' ); // sonorous_open_footer ?>

			<div class="footer-wrap">
				
				<?php get_template_part( 'menu', 'secondary' ); // Loads the menu-secondary.php template. ?>

				<div class="footer-content">
					<?php echo apply_atomic_shortcode( 'footer_content', hybrid_get_setting( 'footer_insert' ) ); ?>
				</div><!-- .footer-content -->

				<?php do_atomic( 'footer' ); // sonorous_footer ?>

			</div><!-- .wrap -->

			<?php do_atomic( 'close_footer' ); // sonorous_close_footer ?>

		</footer><!-- #footer -->
		
	</div><!-- #container -->
	
	<?php if( is_page_template( 'page-template-home.php' ) || is_page_template( 'page-template-background-fullscreen-media.php' ) || hybrid_has_post_template( 'post-template-background-fullscreen-media.php' ) ) : ?>
	
	<!-- Start fullscreen media loop for posts/pages utilizing their relative fullscreen media template -->
	
		<?php wp_reset_postdata(); ?>

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>
			
				<?php if ( get_post_meta( $post->ID, 'video', true ) ) : ?>
				
					<script>
						var $j = jQuery.noConflict();
						$j(document).ready(
							function() {
								$j.backstretchvideo("<?php echo esc_url( get_post_meta( $post->ID, 'video', true ) ) ?>");	
							}
						);
					</script>
					
				<?php elseif ( get_post_meta( $post->ID, 'Video', true ) ) : ?>
					
					<script>
						var $j = jQuery.noConflict();
						$j(document).ready(
							function() {
								$j.backstretchvideo("<?php echo esc_url( get_post_meta( $post->ID, 'Video', true ) ) ?>");	
							}
						);
					</script>

				<?php else : ?>
				
					<script>
						var $j = jQuery.noConflict();

						$j(document).ready(
							function() {

								// Create an array of images that you'd like to use
								var images = [
									<?php sonorous_image_urls(); ?>
								];
								// The index variable will keep track of which image is currently showing
								var index = 0;

								// Call backstretch for the first time,
								// In this case, I'm settings speed of 500ms for a fadeIn effect between images.
								$j.backstretch(images[index], {speed: 500});

								// Set an interval that increments the index and sets the new image
								// Note: The fadeIn speed set above will be inherited
								setInterval(function() {
									index = (index >= images.length - 1) ? 0 : index + 1;
									$j.backstretch(images[index]);
								}, 5000);			
							
							}
						);

					</script>
					
				<?php endif; ?>
				
			<?php endwhile; ?>
			
		<?php endif; // end the_loop ?>
	
	<?php endif; // end page template conditional ?>
	
	<?php do_atomic( 'close_body' ); // sonorous_close_body ?>
	
	<?php wp_footer(); // wp_footer ?>

</body>
</html>