<?php
/**
/*
 * Template Name: Page METALLURGY
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php custom_breadcrumbs(); ?>
			<?php
			
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			wp_reset_query(); ?>
				
			<!-- MATERIAL HANDBOOK TABLE -->
			<h2>Material Handbooks</h2>
			
					<!-- EDIT BUTTON -->					
		<?php get_template_part( 'template-parts/content', 'editbutton' ); ?>

			<table style="max-width:720px;">	
	      		<tr>
		      		<th>Title</th>
		      		<th>Issue</th>
		      		<th>Date</th>
		      	</tr>
		
			<?php 
			/* Setup the query to display all material handbooks */
			$args = array(
				'post_type' => 'material_handbook',
				'post_status' => 'publish',
				'posts_per_page' => -1,
				'orderby' => 'title',
				'order' => 'ASC',
			);
		   	
		   	$loop = new WP_Query( $args );
		     
		   	while ( $loop->have_posts() ) : $loop->the_post(); ?>
		      	
		      		<tr>
		      			<td><a href="<?php echo (esc_url( get_permalink() ) ); ?>"><?php print the_title(); ?></a></td>
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
		
		   	wp_reset_postdata();
			?>
			</table> <!-- MATERIAL HANDBOOKS TABLE -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
