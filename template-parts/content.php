<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		
		<!-- MATERIAL HANDBOOK IMG -->
		<?php	
			if ( in_array( get_post_type( get_the_ID() ), array( 'attachment', 'material_handbook' ) ) && !is_single() ) { //Check post-type is attachment
		    //if is true ?>
				<a href="<?php echo get_permalink(); ?>" rel="bookmark"><img src="http://172.20.20.135/wp-content/themes/xtrac-one/images/icon-file.png" class="media-icon-mh"></a>
		<?php } ?> <!-- close media img -->
		
		<!-- CONDITION ASSESSMENT IMG -->
		<?php
			if ( in_category('condition-assessment') && !is_single() ) { ?>
				<a href="<?php echo get_permalink(); ?>" rel="bookmark"><img src="http://172.20.20.135/wp-content/themes/xtrac-one/images/chart.png" class="media-icon-ca"></a>
		<?php } ?>


		<!-- MATERIAL HANDBOOK IMG -->
		<?php	
			if ( in_array( get_post_type( get_the_ID() ), array( 'guides' ) ) && !is_single() ) { //Check post-type is attachment
		    //if is true ?>
				<a href="<?php echo get_permalink(); ?>" rel="bookmark"><img src="http://172.20.20.135/wp-content/themes/xtrac-one/images/icon-guide.JPG" class="media-icon-guide"></a>
		<?php } ?> <!-- close media img -->
		
		
		<!-- THUMBNAIL -->
		<?php if( is_single() ) { ?>
			<?php if ( has_post_thumbnail() ) : ?>
			<div class="loop-img-single"><a href="<?php echo (esc_url( get_permalink() ) ); ?>"><?php the_post_thumbnail(); ?></a></div> <!-- thumbnail image -->
		<?php endif; //end 'if has post thumbnail' 
				 }else{ 
				if ( has_post_thumbnail() ) : ?>
			<div class="loop-img"><a href="<?php echo (esc_url( get_permalink() ) ); ?>"><?php the_post_thumbnail(); ?></a></div> <!-- thumbnail image -->
		<?php endif; //end 'if has post thumbnail' 
			} ?>
			
		<!-- EDIT BUTTON -->		
		<?php if( is_single() ) { ?>
		<?php get_template_part( 'template-parts/content', 'editbutton' );
			} ?>
		

		<?php if ( is_single() ) : //Just show the title else link to the post ?>
	 	
	 	<!-- CONFIDENTIAL  -->
	 	<?php	
	 	$gtpt = get_post_type_object( get_post_type($post) );	 
	 	
		//add material handbook to loop title
		if( $gtpt->name == 'material_handbook' ) {
			$mh_title = "Material Handbook: ";
		}elseif( $gtpt->name == 'ht_code' ) {
			$mh_title = "Furnace Program: ";
		}else{
			$mh_title = "";
		}
		
	 	
	 	if( $gtpt->name == 'material_handbook' && get_field('customer_friendly') != true || $gtpt->name == 'ht_code' || get_field('confidential') == true ) { ?>	 			
			<h1 class="confidential">CONFIDENTIAL - DO NOT DISTRIBUTE</h1>
	 	<?php } ?>
	 	<!-- END CONFIDENTIAL  -->
	 	
	 	
	 	<h1 class="entry-title"><?php the_title($mh_title); ?></h1>
				
		
		<?php else : //link to the post ?>

		<?php	
	 	$gtpt = get_post_type_object( get_post_type($post) );	 
	 	
		//add material handbook to loop title
		if( $gtpt->name == 'material_handbook' ) {
			$mh_title = "Material Handbook: ";
		}elseif( $gtpt->name == 'ht_code' ){
			$mh_title = "Furnace Program: ";
		}else{
			$mh_title = "";
		}
		

		the_title( '<h2 class="entry-title">' . $mh_title . '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' , '</a></h2>' );
		endif; //end 'if is single' ?>

		<!-- POST META  -->
		<?php get_template_part( 'template-parts/content', 'postmeta' ); ?>
	</header><!-- .entry-header -->
		<!-- CUSTOMER HANDBOOK LINK -->
		<?php 	$args = array(
    				'post_parent' => get_the_ID(), // Current post's ID
    				'post_type' => "material_handbook",
				);
				$children = get_children( $args );
				foreach ( $children as $child ) {
					$child_link = get_permalink( $child->ID );
				}
				// Check if the post has any child
				if ( is_single() && !empty($children) ) { ?>
					<a class="button-blue" href="<?php echo $child_link; ?>">View Customer Friendly Handbook</a>
		<?php 	} elseif( is_single() && $gtpt->name == 'material_handbook' && $post->post_parent ) { ?>
					<a class="button-orange" href="<?php echo get_permalink( $post->post_parent ); ?>">View Full Material Handbook</a>

		<?php } ?>
		
		<!-- END CUSTOMER HANDBOOK LINK -->






	<div class="entry-content">

		<!-- EXCERPT -->					
		<?php get_template_part( 'template-parts/content', 'excerpt' ); ?>
		
		
		<!-- HT CODES CONTENT -->
		<?php if( $gtpt->name == 'ht_code' && !is_home() ) { ?>
		
			<table>
			<tr><th style="width: 200px;">HT Code</th><td><?php the_title(); ?></td></tr>
			<tr><th>Program Number</th><td><?php echo the_field('program_number'); ?></td></tr>
			<tr><th>Temper Code</th><td><?php echo the_field('temper_code'); ?></td></tr>
			<tr><th>Process</th><td><?php echo the_field('process'); ?></td></tr>
			<tr><th>Tempering Temp</th><td><?php echo the_field('tempering_temp'); ?></td></tr>
			<tr><th>Tempering Time</th><td><?php echo the_field('tempering_time'); ?></td></tr>
			<tr><th>S/F Hardness</th><td><?php echo the_field('sf_hardness'); ?></td></tr>
			<tr><th>Case Depth</th><td><?php echo the_field('case_depth'); ?></td></tr>
			<tr><th>Core Hardness</th><td><?php echo the_field('core_hardness'); ?></td></tr>
			<tr><th>Comments</th><td><?php echo the_field('htcode_details'); ?></td></tr>
			<tr><th>Cycle Time</th><td><?php echo the_field('cycle_time'); ?></td></tr>
			</table>

			<?php
			// check if the repeater field has rows of data
			if( have_rows('ht_issuelog') ): ?>
			
			<h3>Change log</h3>
			
			<?php
		 	// loop through the rows of data
		    while ( have_rows('ht_issuelog') ) : the_row();
		    $user = get_sub_field('ht_issuelog_revised_by');
			?>
			<table>
				<tr>
					<th>Issue No</th>
					<th>Date</th>
					<th>Decription</th>
					<th>Revised By</th>
				</tr>
				<tr>
	      			<td><?php echo the_sub_field('issue_no'); ?></td>
	      			<td><?php echo the_sub_field('ht_issuelog_date'); ?></td>
	      			<td><?php echo the_sub_field('ht_issuelog_description'); ?></td>
	      			<td><?php echo $user['display_name']; ?></td>
				</tr>
			</table>
			<?php
		    endwhile;
					    
			
			else :
			
			    // no rows found
			
			endif; ?>

		<?php } ?>
		
		<footer class="entry-footer">
			<?php _s_entry_footer(); ?>
		</footer><!-- .entry-footer -->

	</div><!-- .entry-content -->
			<!-- Sub-pages  -->
		<!-- <?php get_template_part( 'template-parts/content', 'subpages' ); ?> -->


</article><!-- #post-## -->

