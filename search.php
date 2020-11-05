<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package _s
 */

get_header(); ?>

	<section id="primary" class="content-area-nosidebar">
		<main id="main" class="site-main" role="main">
		


		<?php
		if ( have_posts() ) : ?>

		<header class="page-header">
			<h1 class="page-title"><?php printf( $wp_query->found_posts . esc_html__( ' results found for "%s', '_s' ), '<span>' . get_search_query() . '"</span>' ); ?></h1>
		</header><!-- .page-header -->
		
		<!-- Results Filter -->
		<div class="results-filter">
		<h2>Results Filter</h2>
			<?php rlv_category_dropdown(); ?>
		</div>
		
		
		
			<?php
			 xtracONE_paging_nav();
			 
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content' );
				if( current_user_can('administrator') ) { echo "Score: $post->relevance_score"; }

			endwhile;

			xtracONE_paging_nav();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
