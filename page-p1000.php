<?php
/*
 * Template Name: Page P1000
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php custom_breadcrumbs(); ?>
		<?php
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/content', 'p1000' ); 			
			endwhile; // End of the loop.
		wp_reset_query(); ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();

?>