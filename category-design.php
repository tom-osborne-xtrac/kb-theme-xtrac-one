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
			<p>This page lists agreed template parts for a range of common design features and component types. The objective of this page is to provide a continuously updated library of existing designs and knowledge, which:</p>
			<ul>
			<li>Prevents any design / assembly features or components being “reinvented”.</li>
			<li>Acts as a reference that enables designers to continually learn from and record solutions to past and present issues</li>
			<li>Prevent past issues from re-occurring in any new designs.</li>
			<li>Reduces the need for verification of new part features, as parts are assumed to conform with template features from this standard if no verification is present.</li>
			</ul>
				<div id="group-container">
			
						<?php
						$technical_area_terms = get_terms( 'technical_area' );
						$category_terms = get_terms( 'category' );
						
						?>
						
						<?php
						foreach ( $technical_area_terms as $technical_area_term ) {
						    $member_group_query = new WP_Query( array(
						        'post_type' => 'guides',
						        'tax_query' => array(
								    'relation' => 'AND',
						            array(
						                'taxonomy' => 'technical_area',
						                'field' => 'slug',
						                'terms' => array( $technical_area_term->slug ),
						            ),
						            array(
						                'taxonomy' => 'category',
						                'field' => 'slug',
						                'terms' => 'design',
						            )
						        )
						    ) );
						?>
						
						<div id="group-container-item">
						<h2><a href="../../technical_area/<?php echo $technical_area_term->slug; ?>"><?php echo $technical_area_term->name; ?></a></h2> <!--  Technical Area Title -->
						    
						    <?php
						    if ( $member_group_query->have_posts() ) : ?>
						    	<div class="guide-list"><ul> <?php
						    	while ( $member_group_query->have_posts() ) : $member_group_query->the_post(); ?>
						        	<?php the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><li>' , '</li></a>' ); ?>
						    <?php endwhile; ?> 
						    	</ul></div>
						    <?php	else: ?>
						    		No content
						    <?php endif; ?>
						    </div> <!-- close container -->
						    
					<?php	// Reset things, for good measure
						    $member_group_query = null;
						    wp_reset_postdata();
						} //end foreach

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>
		</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
