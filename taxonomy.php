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


			<div class="term-links-container">
			<?php 	
			//TECHNICAL AREA LINKS
			
			$tech_terms_args = array (
				'taxonomy' => 'technical_area',
				'parent' => 0,
			);
			
			$tech_terms = get_categories( $tech_terms_args );
			
			
						
			if ( is_tax( 'technical_area' ) ) {
			
			//	wp_list_categories( apply_filters( '', $tech_terms_args ) );
			
				foreach ($tech_terms as $tech_term) {
					
					//get term link
					$tech_term_link = get_term_link( $tech_term );
					$tech_term_name = $tech_term->name;
					$tech_term_count = $tech_term->count;

				
					echo "<div class='term-link'>";
					echo "<a href='" . $tech_term_link . "'>";
					echo $tech_term_name . ' (' . $tech_term_count . ')';
					echo "</a>";
					echo "</div>";
				
				} // end foreach			
			} // end if ?>
			
			</div>
			<?php
			$current_tech_term = get_queried_object();
			$ctt_children = get_queried_object()->term_id;
		
			$children = get_term_children( $ctt_children, 'technical_area' ); 
			$parent = ( isset( $current_tech_term->parent ) ) ? get_term_by( 'id', $current_tech_term->parent, 'technical_area' ) : false;
			$parent_children = get_term_children( $current_tech_term->parent, 'technical_area' );
			
			if( $children ) { ?>
			
			<hr>
			<h3>Sub-categories</h3>
			<div class="term-links-container">

			<?php
			foreach ($children as $child) {
				$name = get_term( $child );
				$link = get_term_link( $child );
				$count = $name->count;
				
					echo "<div class='term-link'>";
					echo "<a href='" . $link . "'>";
						echo $name->name . ' (' . $count . ')';
					echo "</a>";
					echo "</div>";

			} //end foreach
			?>
			</div><!-- close term-links-container for sub-cats on parent-cat -->
			
			<?php
			} //end if
			?>

			<?php
			if( $parent ) { ?>

			<hr>
			<h3>Sub-categories</h3>
			<div class="term-links-container">

			<?php
			foreach ($parent_children as $child) {
				$name = get_term( $child );
				$link = get_term_link( $child );
				$count = $name->count;
				
					echo "<div class='term-link'>";
					if(is_category($name)) {
						echo "test";
					}
					echo "<a href='" . $link . "'>";
						echo $name->name . ' (' . $count . ')';
					echo "</a>";
					echo "</div>";

			}	?>
		
			</div><!-- close term-links-container for sub-cats on sub-cat -->
			<?php 	} //end if	?>	
			
			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->
			
			<?php //PAGE NAV links
			 xtracONE_paging_nav();
			 ?>
				 <table>
				 <th>Project</th>
				 <th>Title</th>
				 <th>Date</th>
				 <th>Author</th>
			 <?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				 
				 ?>
				 <?php
				get_template_part( 'template-parts/content', 'list' );
				?>
				

			<?php 
			endwhile; 
			?>

				</table>
				<?php
			 xtracONE_paging_nav();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
