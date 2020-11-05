<!-- Start Post Meta --- POST TYPE | CATEGORY | DATE by AUTHOR | PRINT -->
<div class="post-info">

	<!-- ARCHIVE, SEARCH, FRONT PAGE OR HOME SPECIFIC -->
	 <?php if ( is_archive() || is_front_page() || is_home() || is_search() || is_page() ) : ?>
	 
	 	<!-- MATERIAL HANDBOOKS ISSUE NUMBER IN LOOP -->
	 	
	 	<?php $gtpt = get_post_type_object( get_post_type($post) );
	 	 	
			//confidential	 or customer friendly
	 		if( $gtpt->name == 'material_handbook' && !$post->post_parent ) { ?>
	 			<strong>
	 				<span class="confidential">CONFIDENTIAL</span> | 
	 				<?php echo the_field('material_code') . ' | Issue ';
	 				echo the_field('document_issue') . ' | '; 
	 				echo the_field('material_type') . ' | '; ?>
	 			</strong>
	 		<?php }elseif( $gtpt->name == 'material_handbook' && $post->post_parent ) { ?>
	 			<strong>
	 				<span class="customer-handbook">CUSTOMER FRIENDLY</span> | 
	 				<?php echo the_field('material_code') . ' | Issue ';
	 				echo the_field('document_issue') . ' | '; 
	 				echo the_field('material_type') . ' | '; ?>
	 			</strong>
			
			<?php } ?>
	 	
		<!-- POST TYPE -->
		<span class="theposttype">
			<?php $cpt = get_post_type_object( get_post_type($post) );
						if( $cpt->name == 'page' ):
							echo'';
						else: ?>			
					<a href="<?php $post_type_link = get_post_type_archive_link( get_post_type($post) ); echo $post_type_link; ?>"><?php echo $cpt->labels->singular_name ; ?></a>
				</span> |
			<?php endif; ?> 
		
		<!-- CATEGORY -->
		<?php if( has_term( '', 'category' ) ): //only if category is used ?>
			<span class="thecategory">
				<?php the_category(', ') ?>
			</span> | 
		<?php endif; //end category check ?> 
		
		<!-- SALES TERRITORY-->		
		<?php 	$sT_terms = wp_get_object_terms( $post->ID, 'sales_territory' );
					foreach( $sT_terms as $sT_term ) { ?>
						<a href="<?php $term_link = get_term_link( $sT_term ); echo $term_link; ?>"><?php echo $sT_term->name; ?></a> | 
					<?php } ?>
		<!-- TECHNICAL AREA -->		
		<?php 	$sT_terms = wp_get_object_terms( $post->ID, 'technical_area' );
					foreach( $sT_terms as $sT_term ) { ?>
						<a href="<?php $term_link = get_term_link( $sT_term ); echo $term_link; ?>"><?php echo $sT_term->name; ?></a> |  
					<?php } ?>
		
		
	<?php endif; //end archive or home specific ?>

 	<?php if ( is_single() ) : ?>

	 	<!-- MATERIAL HANDBOOKS ISSUE NUMBER IN HANDBOOK PAGE -->
	 	
	 	<?php $gtpt = get_post_type_object( get_post_type($post) );
	 	 		
	 		if( $gtpt->name == 'material_handbook' ) { ?>
	 			
	 			<strong>
	 			<?php 
	 			echo the_field('material_code') . ' | Issue ';
	 			echo the_field('document_issue') . ' | '; 
	 			echo the_field('material_type') . ' | '; ?>
	 			</strong>
	 		<?php } ?>

	<?php endif; //end single specific ?>
	
	 <!-- SINGLE, ARCHIVE OR HOME -->
 	<?php if ( is_archive() || is_front_page() || is_home() || is_search()  || is_single() ) : ?>



		<!-- POST DATE -->
		<span class="thetime">
			<?php the_time( get_option( 'date_format' ) ); ?>
		</span>
		

		<!-- AUTHOR -->
		<span class="theauthor">
			by <?php the_author_posts_link(); ?>
		</span> 
	<?php endif; ?>

	<!-- SINGLE -->
 
 	<!-- PRINT BUTTON -->
	<?php if ( is_single() || is_page() && !is_front_page() ) : ?>
		<span class="thecategory">
			<a href="javascript:window.print()" class="button-grey print-button" title="Print"><img src="/wp-content/uploads/print-icon.png" class="print-icon"></a>
		</span>
	<?php endif; ?>
	
</div> <!-- close post info --?
<!-- End Post Meta -->
