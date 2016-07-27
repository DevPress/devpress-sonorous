<?php
/**
 * Template Name: Fullscreen Media
 *
 * @package sonorous
 * @subpackage Template
 */

 get_header( 'blank' ); ?>
 
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

<?php get_footer( 'blank' ); ?>