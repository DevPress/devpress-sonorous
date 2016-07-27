<?php
/**
 * Template Name: Background Fullscreen Media
 *
 * @package sonorous
 * @subpackage Template
 */

get_header(); // Loads the header.php template. ?>

	<?php do_atomic( 'before_content' ); // sonorous_before_content ?>

	<div id="content">

		<?php do_atomic( 'open_content' ); // sonorous_open_content ?>

		<div class="hfeed">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php do_atomic( 'before_entry' ); // sonorous_before_entry ?>

					<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

						<?php do_atomic( 'open_entry' ); // sonorous_open_entry ?>

						<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
						
						<div class="entry-content">
							
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'sonorous' ), 'after' => '</p>' ) ); ?>

						</div><!-- .entry-content -->
						
						<?php echo apply_atomic_shortcode( 'entry_edit_link', '[entry-edit-link]' ); ?>

						<?php do_atomic( 'close_entry' ); // sonorous_close_entry ?>

					</div><!-- .hentry -->

					<?php do_atomic( 'after_singular' ); // sonorous_after_singular ?>

					<?php
						// If comments are open or we have at least one comment, load the comments template.
						if ( comments_open() || '0' != get_comments_number() )
							comments_template( '/comments.php', true ); // Loads the comments.php template.
					?>

				<?php endwhile; ?>

			<?php endif; ?>

		</div><!-- .hfeed -->
		
		<?php do_atomic( 'close_content' ); // sonorous_close_content ?>

		<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // sonorous_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>