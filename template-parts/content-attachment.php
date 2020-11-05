<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header-page">
		
		<!-- EDIT BUTTON -->					
		<?php get_template_part( 'template-parts/content', 'editbutton' ); ?>

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		
		<!-- POST META  -->
		<?php get_template_part( 'template-parts/content', 'postmeta' ); ?>
		
		<!-- Sub-pages  -->
		<?php get_template_part( 'template-parts/content', 'subpages' ); ?>


	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', '_s' ),
				'after'  => '</div>',
			) );
		?>
		
		<!-- FEATURED  -->
		<?php get_template_part( 'template-parts/content', 'latestposts' ); ?>

	</div><!-- .entry-content -->
</article><!-- #post-## -->