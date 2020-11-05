<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */

?>
<!-- content-deptpage.php -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<!-- EDIT BUTTON -->					
							<?php 
							global $post, $current_user;
								wp_get_current_user();
							
							if( current_user_can( 'edit_others_posts', $post->ID ) || ($post->post_author == $current_user->ID)) : ?>
								<span class="readMore">
									<button class="callToAction_plain" onClick="window.open('<?php echo get_edit_post_link( get_the_ID() ); ?>')">Edit page</button></span>
							<?php elseif( current_user_can('level_10') ) : ?>
								<span class="readMore">
									<button class="callToAction_plain" onClick="window.open('<?php echo get_edit_post_link( get_the_ID() ); ?>')">Edit page</button></span>
							<?php endif; ?>
	<!-- END EDIT BUTTON -->

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			while ( have_posts() ) : the_post();
				the_content();
			endwhile; // End of the loop.
			wp_reset_query();
		?>
	<h1>Latest  <a href="<?php echo esc_url( get_category_link('1833') ); ?>"><?php echo get_the_category_by_id('1833'); ?></a> 	</h1>
			<table>
			<?php query_posts('cat=1833'); ?>
				<?php 	if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<tr><td>		<?php the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' , '</a>' ); ?> </td></tr>
				<?php	endwhile;
						endif; ?>
			 </table>
	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php _s_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
