<?php
/*
 * Template Name: Page HOME
 *
 * This is the template that displays the front page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */

get_header();
?>

	<div id="primary" class="content-area-nosidebar">
		<main id="main" class="site-main" role="main">
		
		<!-- Breadcrumbs -->
		<div class="breadcrumbs" typeof="BreadcrumbList">
		    <?php if(function_exists('bcn_display'))
		    {
		        bcn_display();
		    }?>
		</div>
		<h1>Xtrac Knowledge Base</h1>
			
			<p>Welcome to the Xtrac Knowledge Base. If you experience any problems or have any feedback, please email <a href="mailto:tom_osborne@xtrac.com">Tom Osborne</a>.</p>
		
		<h2 class="frontTitle">Latest Uploads</h2>
 
		<?php	xtracONE_paging_nav(); ?>
		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			xtracONE_paging_nav();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
