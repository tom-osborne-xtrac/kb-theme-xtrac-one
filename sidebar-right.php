<?php
/**
 * The sidebar containing the secondary widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
 */

 ?>

<div id="rsb-offset"></div>
<aside id="secondary" class="widget-area-right logged-in" role="complementary">

	<?php if ( is_single() ) { ?>
		
<!-- POST INFORMATION -->		
		<section id="post-info-widget" class="widget">
		
		<h2 class="widget-title">POST INFORMATION</h2>
		
		<ul>
		<!--DISPLAY POST TYPE -->
		<li class="widget-subtitle">Post Type:</li>
		<li><a href="<?php $post_type_link = get_post_type_archive_link( get_post_type($post) ); echo $post_type_link; ?>"><?php $post_type = get_post_type_object( get_post_type( $post->ID ) ); echo $post_type->labels->singular_name; ?></a>
		</li>
		
		<!--DISPLAY CUSTOMER HANDBOOK LINK -->
		<li class="widget-subtitle">Post Type:</li>
		<li><a href="<?php $post_type_link = get_post_type_archive_link( get_post_type($post) ); echo $post_type_link; ?>"><?php $post_type = get_post_type_object( get_post_type( $post->ID ) ); echo $post_type->labels->singular_name; ?></a>
		</li>

		<!-- DISPLAY POST CATEGORY -->
		<li class="widget-subtitle">
		<?php if( has_term( '', 'category' ) ): //only if category is used ?>
			Category: </li><li>
				<?php
				// heres just the name and permalink:
				foreach((get_the_category()) as $category) { ?>
					<a href="<?php echo get_category_link($category->cat_ID);; ?>"><?php echo $category->cat_name . ' '; ?></a>
				<?php } ?>
		<?php endif; //end category check ?> 

		</li>
		<!-- DISPLAY PROJECT CODE -->
		
		<?php 	$sT_terms = wp_get_object_terms( $post->ID, 'project_code' );
					if ( empty($sT_terms) ) { //checks for terms and only displays if terms are present
					} else { ?>
						<li class="widget-subtitle">Project Codes:</li>
								<?php foreach( $sT_terms as $sT_term ) { ?>
									<li><a href="<?php $term_link = get_term_link( $sT_term ); echo $term_link; ?>"><?php echo $sT_term->name; ?></a></li>
								<?php } ?>
			<?php   } ?>
		<!-- CLOSE PROJECT CODE -->
		
		<!-- DISPLAY SALES TERRITORIES -->
		<?php 	$sT_terms = wp_get_object_terms( $post->ID, 'sales_territory' );
					if ( empty($sT_terms) ) { //checks for terms and only displays if terms are present
					} else { ?>
								<li class="widget-subtitle">Sales Territories:</li>

								<?php foreach( $sT_terms as $sT_term ) { ?>
									<li><a href="<?php $term_link = get_term_link( $sT_term ); echo $term_link; ?>"><?php echo $sT_term->name; ?></a></li>
								<?php } ?>
			<?php   } ?>
		
		<!-- CLOSE SALES TERRITORIES-->
		
		<!-- DISPLAY TECHNICAL AREAS -->
		
		<?php 	$sT_terms = wp_get_object_terms( $post->ID, 'technical_area' );
					if ( empty($sT_terms) ) { //checks for terms and only displays if terms are present
					} else { ?>
						<li class="widget-subtitle">Technical Areas:</li>
								<?php foreach( $sT_terms as $sT_term ) { ?>
									<li><a href="<?php $term_link = get_term_link( $sT_term ); echo $term_link; ?>"><?php echo $sT_term->name; ?></a></li>
								<?php } ?>
			<?php   } ?>
		
		<!-- CLOSE TECHNICAL AREAS -->
		</ul>
		</section>
<!-- CLOSE POST INFORMATION -->

<?php if( is_search() ) {
			rlv_category_dropdown();
			}

		   } ?>		
		
	<?php if ( is_dynamic_sidebar( 'right' ) ) {
				dynamic_sidebar( 'right' ); } ?>
</aside><!-- #secondary -->
