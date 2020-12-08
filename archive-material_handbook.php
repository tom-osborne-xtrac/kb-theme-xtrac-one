<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */

get_header(); ?>

	<div id="primary" class="content-area-nosidebar">
		<main id="main" class="site-main" role="main">
		<?php custom_breadcrumbs(); ?>
		
		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h1>Material Handbooks</h1>
			</header><!-- .page-header -->
			
			<!-- EDIT BUTTON -->					
			<?php get_template_part( 'template-parts/content', 'editbutton' ); ?>
			
			<a href="http://172.20.20.135/wp-content/uploads/Materials-price-guide_Oct20.pdf" class="button-green" style="float:right; margin: 0;">Material Pricing</a>
			
						
			<div class="filter-input"><input type="text" id="tableFilterInput" onkeyup="tableFilter('tableFilterInput', 'materials_table', 2)" placeholder="Filter by material name..."></div>

			<!-- MATERIAL HANDBOOK TABLE -->
			<table id="materials_table">	
	      		<tr>
		      		<th>Material Type</th>
		      		<th>Material Code</th>
		      		<th>Material Name</th>
		      		<th>Author</th>
		      		<th>Issue</th>
		      		<th>Issue Date</th>
		      	</tr>
		
			<?php 
			/* Setup the query to display all material handbooks */
			$args = array(
				'post_type' => 'material_handbook',
				'post_status' => 'publish',
				'posts_per_page' => -1,
				'meta_key' => 'material_code',
				'orderby' => 'meta_value',
				'order' => 'ASC',
				'post_parent' => 0,
			);
		   	
		   	$loop = new WP_Query( $args );
		     
		   	while ( $loop->have_posts() ) : $loop->the_post(); ?>
		      	
		      		<tr data-href="<?php echo (esc_url( get_permalink() ) ); ?>">
		      			<td><?php echo the_field('material_type'); ?></td>
		      			<td><?php echo the_field('material_code'); ?></td>
		      			<td><a href="<?php echo (esc_url( get_permalink() ) ); ?>" style="font-weight: bold;"><?php print the_title(); ?></a></td>
		      			<td><?php echo get_the_author_meta('display_name') ?></td>
		      			<td><?php $gtpt = get_post_type_object( get_post_type($post) );
					 			if( $gtpt->name == 'material_handbook' ) {
					 				echo 'Issue ';
					 				echo the_field('document_issue');
	 							} ?>
						</td>
						<td><?php the_time( get_option( 'date_format' ) ); ?></td>
		      		</tr>
		      
		      	
		      	
		    <?php  	
		   	endwhile;
		
			?>
			</table> <!-- MATERIAL HANDBOOKS TABLE -->

	<?php	else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
