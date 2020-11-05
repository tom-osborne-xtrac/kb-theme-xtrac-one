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
		
		<!-- FEATURED IMG -->
		<?php if ( has_post_thumbnail() ) : ?>
				<div class="featured-img-top">
					<a href="<?php the_post_thumbnail_url( 'full' ); ?>"><?php the_post_thumbnail( 'full' ); ?></a>
				</div> 
		<?php endif; //end 'if has post thumbnail' ?> 

		
		<!-- EDIT BUTTON -->					
		<?php get_template_part( 'template-parts/content', 'editbutton' ); ?>

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		
		<!-- POST META  -->
		<?php get_template_part( 'template-parts/content', 'postmeta' ); ?>
		

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php	the_content(); ?>

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
		                'terms' => array( 'p1000-guides', 'guides'),
		            )
		        )
		    ) );
		?>
		
		<h2><a href="../../../technical_area/<?php echo $technical_area_term->slug; ?>"><?php echo $technical_area_term->name; ?></a></h2> <!--  Technical Area Title -->
		    <?php
		    if ( $member_group_query->have_posts() ) : ?>
					
					<table>
					 	<tr>
					 		<th>Title</th>
				      		<th>Issue</th>
				      		<th>Date</th>
				      	</tr>	<?php
		    	while ( $member_group_query->have_posts() ) : $member_group_query->the_post(); ?>
		        	<tr>
		        		<td><?php the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' , '</a>' ); ?></td>
		        		<td></td>
		        		<td><?php the_time( get_option( 'date_format' ) ); ?></td>
		        	</tr>
		        	
		    <?php endwhile; ?> 
		    	</table>
		    <?php	else: ?>
		    		No content
		    <?php endif; ?>
		    
		<?php	// Reset things, for good measure
		    $member_group_query = null;
		    wp_reset_postdata();
		} //end foreach
		    

			?>
</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php _s_entry_footer(); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->