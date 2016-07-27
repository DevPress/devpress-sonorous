<?php
/**
 * Post Template
 *
 * This is the default post template.  It is used when a more specific template can't be found to display
 * singular views of the 'post' post type.
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
						
						<?php echo apply_atomic_shortcode( 'byline', '<div class="byline">' . '[entry-author] [entry-published]' . '</div>'); ?>
						
						<div class="entry-content">
							
							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sonorous' ) ); ?>
							<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'sonorous' ), 'after' => '</p>' ) ); ?>

						</div><!-- .entry-content -->

						<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">' . __( 'Filed under: [entry-terms taxonomy="category"] [entry-terms taxonomy="post_tag" before="and Tagged: "]', 'sonorous' ) . '</div>' ); ?>
						
						<?php echo apply_atomic_shortcode( 'entry_edit_link', '[entry-edit-link]' ); ?>

						<?php do_atomic( 'close_entry' ); // sonorous_close_entry ?>

					</div><!-- .hentry -->

					<?php do_atomic( 'after_singular' ); // sonorous_after_singular ?>

					<?php comments_template( '/comments.php', true ); // Loads the comments.php template. ?>

				<?php endwhile; ?>

			<?php endif; ?>
			
			<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

		</div><!-- .hfeed -->
		
		<?php do_atomic( 'close_content' ); // sonorous_close_content ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // sonorous_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>