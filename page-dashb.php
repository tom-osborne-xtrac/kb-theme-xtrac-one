<?php
/*
 * Template Name: Page DASHBOARD
 */

get_header(); ?>

<div id="primary" class="dashb-container">
	<main id="main" class="site-main" role="main">
		<div class="dashb-bc"><?php custom_breadcrumbs(); ?></div>
		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'dashb' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
