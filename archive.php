<?php
/**
 * The template for displaying archive pages.
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
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<div class="term-links-container">
			<?php 	
			//TECHNICAL AREA LINKS
			
			$tech_terms = get_terms( 'technical_area' );
			
			
						
			if ( is_tax( 'technical_area' ) ) {
				foreach ($tech_terms as $tech_term) {
					
					//get term link
					$tech_term_link = get_term_link( $tech_term );
				
					echo "<div class='term-link'>";
					echo "<a href='" . $tech_term_link . "'>";
					echo $tech_term->name;
					echo "</a>";
					echo "</div>";
				}			
			} ?>
			
			</div>
			
			
			<?php //PAGE NAV links
			 xtracONE_paging_nav();
			 
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
//get_sidebar();
get_footer();
