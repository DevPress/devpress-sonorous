<?php
/**
 * Index Template
 *
 * This is the default template.  It is used when a more specific template can't be found to display
 * posts.  It is unlikely that this template will ever be used, but there may be rare cases.
 *
 * @package sonorous
 * @subpackage Template
 */

get_header(); // Loads the header.php template. ?>

<?php do_atomic( 'before_content' ); // sonorous_before_content ?>

<div id="content">

	<?php do_atomic( 'open_content' ); // sonorous_open_content ?>
	
	<div class="hfeed">
	
		<ul class="loop-entries">
	
		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>
			
			<?php do_atomic( 'before_entry' ); // sonorous_before_entry ?>
			
			<li id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

				<?php do_atomic( 'open_entry' ); // sonorous_open_entry ?>
				
				<div class="entry-preview">

					<?php
						if ( current_theme_supports( 'get-the-image' ) ) {
							get_the_image( array( 'size' => 'sonorous-thumbnail-tiny', 'link_to_post' => false ) );
						}
					?>
				
					<h2 class="entry-title"><?php the_title(); ?></h2>
					

						<div class="entry-summary">
							<?php the_excerpt(); ?>
						</div><!-- .entry-summary -->


				</div><!-- .entry-preview -->
				
				<div class="entry-full">
				
					<?php echo apply_atomic_shortcode( 'comments_link', '[entry-comments-link zero="0" one="%1$s" more="%1$s"]'); ?>
				
					<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
					
					<?php echo apply_atomic_shortcode( 'byline', '<div class="byline">' . __( '[entry-author] [entry-published]', 'sonorous' ) . '</div>'); ?>
					
					<div class="entry-content">
						<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sonorous' ) ); ?>
						<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'sonorous' ), 'after' => '</p>' ) ); ?>
					</div><!-- .entry-content -->
					
					<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">' . __( 'Filed under: [entry-terms taxonomy="category"] [entry-terms taxonomy="post_tag" before="and Tagged: "]', 'sonorous' ) . '</div>' ); ?>
					
					<?php echo apply_atomic_shortcode( 'entry_edit_link', '[entry-edit-link]' ); ?>
					
				</div><!-- .entry-full -->

				<?php do_atomic( 'close_entry' ); // sonorous_close_entry ?>

			</li><!-- .hentry -->
			
			<?php do_atomic( 'after_entry' ); // sonorous_after_entry ?>
			
			<?php endwhile; ?>

			<?php else : ?>
			
			<li class="<?php hybrid_entry_class(); ?>">
				
				<div class="entry-error">
					<p><?php _e( 'Apologies, but no entries were found.', 'sonorous' ); ?></p>
				</div><!-- .entry-error -->
				
			</li><!-- .hentry .error -->

		<?php endif; ?>
		
		</ul><!-- .loop-entries -->
		
		<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>
		
	</div><!-- .hfeed -->
	
	<?php do_atomic( 'close_content' ); // sonorous_close_content ?>

</div><!-- #content -->

<?php do_atomic( 'after_content' ); // sonorous_after_content ?>

<?php get_footer(); // Loads the header.php template. ?>